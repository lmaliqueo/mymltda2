<?php

namespace app\controllers;

use Yii;
use app\models\EstadoPago;
use app\models\EstadoPagoSearch;
use app\models\OrdenTrabajo;
use app\models\Actividades;
use app\models\Proyecto;
use app\models\ActSactAsigna;
use app\models\AsignaTiene;
use app\models\SactMatConsume;
use app\models\StockMateriales;
use app\models\CantidadUtilizada;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\base\Model;

/**
 * EstadoPagoController implements the CRUD actions for EstadoPago model.
 */
class EstadoPagoController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all EstadoPago models.
     * @return mixed
     */
    public function actionIndex($id)
    {
        $ordentrabajo= OrdenTrabajo::findOne($id);
        $otid= OrdenTrabajo::find()->select('OT_ID')->where(['PRO_ID'=>$ordentrabajo->PRO_ID])->asArray()->all();
        $acid= Actividades::find()->select('AC_ID')->where(['OT_ID'=>$otid])->asArray()->all();
        $asid= ActSactAsigna::find()->select('AS_ID')->where(['AC_ID'=>$acid])->asArray()->all();
        $epid= AsignaTiene::find()->select('EP_ID')->where(['AS_ID'=>$asid])->asArray()->all();
        $searchModel = new EstadoPagoSearch();
        $dataProvider = new ActiveDataProvider([
            'query' => EstadoPago::find()->
                where(['EP_ID'=>$epid]),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);


        //$searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'ordentrabajo' => $ordentrabajo,
        ]);
    }

    /**
     * Displays a single EstadoPago model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model= $this->findModel($id);
        $ep_asig= AsignaTiene::find()->where(['EP_ID'=>$id])->all();
        return $this->render('view', [
            'model' => $model,
            'ep_asig' => $ep_asig,
        ]);
    }

    /**
     * Creates a new EstadoPago model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        $model = new EstadoPago();

        $proyecto= Proyecto::findOne($id);
        $otid= OrdenTrabajo::find()->select('OT_ID')->where(['PRO_ID'=>$id])->asArray()->all();
        $actividades= Actividades::find()->where(['OT_ID'=>$otid])->andWhere(['not in','AC_ESTADO','Finalizado'])->all();
        $acid= Actividades::find()->select('AC_ID')->where(['OT_ID'=>$otid])->andWhere(['not in','AC_ESTADO','Finalizado'])->asArray()->all();
        $asignados= ActSactAsigna::find()->where(['AC_ID'=>$acid])->all();
        
        $arrayasig= ActSactAsigna::find()->select('AS_ID')->where(['AC_ID'=>$acid])->asArray()->all();
        $epexiste= AsignaTiene::find()->where(['AS_ID'=>$arrayasig])->orderBy(['EP_ID'=>SORT_DESC,])->one();




        if (!empty($epexiste)) {
            $model->EP_NUMEROEP=$epexiste->eP->EP_NUMEROEP + 1;
            $tieneanterior= AsignaTiene::find()->where(['AS_ID'=>$arrayasig, 'EP_ID'=>$epexiste->EP_ID])->all();
        }else{
            $model->EP_NUMEROEP=1;
        }
        $model->EP_FECHA= date('Y-m-d');



        $arreglo=[new AsignaTiene()];
        foreach ($asignados as $asi) {
            $tiene = new AsignaTiene();
            $tiene->AS_ID = $asi->AS_ID;
            $tiene->AT_CANTIDAD = 0;
            $tiene->AT_COSTO_EP = 0;
            $arreglo[]=$tiene;



        }



        if (Model::loadMultiple($arreglo, Yii::$app->request->post()) ) {
            $model->save();
            $flag=0;
            foreach ($arreglo as $key) {
                if ($key->AT_CANTIDAD!=0) {
                    $key->EP_ID=$model->EP_ID;
                    foreach ($asignados as $actual) {
                        if ($actual->AS_ID==$key->AS_ID) {
                            $actual->AS_CANTIDADACTUAL=$key->AT_CANTIDAD+$actual->AS_CANTIDADACTUAL;
                            $key->AT_COSTO_EP=($actual->AS_COSTOTOTAL/$actual->AS_CANTIDAD)*$key->AT_CANTIDAD;

                            $actual->AS_COSTOACTUAL=$key->AT_COSTO_EP+$actual->AS_COSTOACTUAL;
                            $actual->save();
                            break;
                        }
                    }
                    $key->save();
                }
            }
            foreach ($arreglo as $ac) {
                if ($ac->AT_CANTIDAD!=0) {

                    $idactividad=ActSactAsigna::find()->where('AC_ID <> :x',[':x'=>$flag])->andWhere(['AS_ID'=>$ac->AS_ID])->one();
                    if(!empty($idactividad)){
                        $flag=$this->verificarActividad($idactividad->AC_ID);
                    }
                }

            }
            return $this->redirect(['view', 'id' => $model->EP_ID]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'arreglo' => $arreglo,
                'asignados' => $asignados,
                'actividades' => $actividades,
                'proyecto' => $proyecto,
            ]);
        }
    }

    /**
     * Updates an existing EstadoPago model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->EP_ID]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing EstadoPago model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the EstadoPago model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return EstadoPago the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = EstadoPago::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionGenerarEp($id)
    {
        $epactual= EstadoPago::findOne($id);

      
        $asignatiene= AsignaTiene::find()->where(['EP_ID'=>$id])->all();

        $idasigna= AsignaTiene::find()->select('AS_ID')->where(['EP_ID'=>$id])->asArray()->all();
        $idsubact= ActSactAsigna::find()->select('SACT_ID')->where(['AS_ID'=>$idasigna])->asArray()->all();
        $idmaterial= SactMatConsume::find()->select('MA_ID')->where(['SACT_ID'=>$idsubact])->asArray()->all();
        $idac= ActSactAsigna::find()->select('AC_ID')->where(['AS_ID'=>$idasigna])->asArray()->all();
        $idot= Actividades::find()->select('OT_ID')->where(['AC_ID'=>$idac])->asArray()->all();
        $cantmat= SactMatConsume::find()->where(['SACT_ID'=>$idsubact])->all();

        $stockmat= StockMateriales::find()->where(['OT_ID'=>$idot])->andWhere(['MA_ID'=>$idmaterial])->all();


        $arreglo=[new CantidadUtilizada()];


        foreach ($stockmat as $mat) {
            $tiene = new CantidadUtilizada();
            $tiene->CU_CANTIDAD = 0;
            foreach ($cantmat as $cantidad) {
                if ($mat->MA_ID==$cantidad->MA_ID) {
                    foreach ($asignatiene as $subact) {
                        if ($subact->aS->sACT->SACT_ID==$cantidad->SACT_ID) {
                            $tiene->CU_CANTIDAD= ($subact->AT_CANTIDAD*$cantidad->CONS_CANTMATERIAL)+$tiene->CU_CANTIDAD;
                            $tiene->CU_FECHA_FINAL= $epactual->EP_FECHA;
                        }
                    }
                }
            }

            $tiene->SM_ID=$mat->SM_ID;
            $arreglo[]=$tiene;

        }

        if (Model::loadMultiple($arreglo, Yii::$app->request->post()) ) {
            foreach ($arreglo as $utilizado) {
                $utilizado->save();
                foreach ($stockmat as $stock) {
                    if ($stock->SM_ID == $utilizado->SM_ID) {
                        $stock->SM_CANTIDAD= $stock->SM_CANTIDAD - $utilizado->CU_CANTIDAD;
                        $stock->save();
                        break;
                    }
                }
            }
            return $this->redirect(['view', 'id' => $id]);

        } else {
            return $this->renderAjax('asignar_cantidad', [
                'model' => $epactual,
                'stockmat' => $stockmat,
                'arreglo' => $arreglo,
            ]);
        }


    }


    protected function verificarActividad($id)
    {
        $idact= ActSactAsigna::findOne($id);
        $actividad= Actividades::findOne($idact->AC_ID);
        $items= ActSactAsigna::find()->where(['AC_ID'=>$id])->all();
        if ($actividad->AC_ESTADO=='En proceso') {
            $flag=0;
            foreach ($items as $item) {
                if ($item->AS_CANTIDAD==$item->AS_CANTIDADACTUAL && $flag!=2) {
                }else{
                    return $idact->AC_ID;
                    break;
                }
            }
            $actividad->AC_ESTADO='Finalizado';
            $actividad->save();
            return $idact->AC_ID;
        }else{
            return $idact->AC_ID;
        }    
    }
}
