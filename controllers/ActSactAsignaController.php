<?php

namespace app\controllers;

use Yii;
use app\models\ActSactAsigna;
use app\models\Subactividades;
use app\models\Actividades;
use app\models\ActSactAsignaSearch;
use app\models\SactMatConsume;
use app\models\SactHeOcupan;
use app\models\SactObRequiere;
use app\models\MaterialAsignado;
use app\models\HerramientaAsignado;
use app\models\HerramientaTiene;
use app\models\Herramientas;
use app\models\Materiales;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\base\Model;

/**
 * ActSactAsignaController implements the CRUD actions for ActSactAsigna model.
 */
class ActSactAsignaController extends Controller
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
     * Lists all ActSactAsigna models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ActSactAsignaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ActSactAsigna model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ActSactAsigna model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        $model = new ActSactAsigna();
        $actividad = Actividades::findOne($id);
        $asignados= ActSactAsigna::find()->where(['AC_ID'=>$id])->all();
        $model->AC_ID=$id;
        $subactividadasignados = ActSactAsigna::find()->select('SACT_ID')->where(['AC_ID'=>$id])->asArray()->all();
        $subactividades = Subactividades::find()->where(['not in','SACT_ID',$subactividadasignados])->all();
        $model->AS_CANTIDADACTUAL=0;
        $model->AS_COSTOACTUAL=0;
        $model->AS_COSTOTOTAL=0;
        if ($model->load(Yii::$app->request->post())) {
        
            $model->save();
            
            return $this->redirect(['create', 'id' => $id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'asignados' => $asignados,
                 'actividad' => $actividad,
                 'subactividades' => $subactividades,
           ]);
        }
    }

    /**
     * Updates an existing ActSactAsigna model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->AS_ID]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ActSactAsigna model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model=$this->findModel($id);
        $idOT=$model->aC->OT_ID;
        $model->delete();

        return $this->redirect(['actividades/calendario', 'id'=>$idOT]);
    }

    /**
     * Finds the ActSactAsigna model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ActSactAsigna the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ActSactAsigna::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    public function actionGetCostoHe($id){
        $costo_he= Herramientas::findOne($id);
        echo Json::encode($costo_he);
    }
    public function actionGetCostoMa($id){
        $costo_ma= Materiales::findOne($id);
        echo Json::encode($costo_ma);
    }
    public function actionGetCostoTotal($cantidad, $id){
        $subact= Subactividades::findOne($id);

        $costototal= $cantidad*$subact->SACT_COSTO;
        echo $costototal;
    }
    public function actionGetSubactividad($id){
        $subact= Subactividades::findOne($id);
        $materiales= SactMatConsume::find()->where(['SACT_ID'=>$id])->all();
        $herramientas= SactHeOcupan::find()->where(['SACT_ID'=>$id])->all();
        $obreros= SactObRequiere::find()->where(['SACT_ID'=>$id])->all();
            return $this->renderAjax('subactividad', [
                'subact' => $subact,
                'materiales' => $materiales,
                'herramientas' => $herramientas,
                'obreros' => $obreros,
            ]);
    }
    public function actionAsignarRecursos($id)
    {
        $model= ActSactAsigna::findOne($id);
        $actividad= Actividades::findOne($model->AC_ID);
        $materiales= SactMatConsume::find()->where(['SACT_ID'=>$model->SACT_ID])->all();
        $obreros=SactObRequiere::find()->where(['SACT_ID'=>$model->SACT_ID])->all();


        $arreglo_mat=[new MaterialAsignado()];
        foreach ($materiales as $mat) {
            $asignar_mat = new MaterialAsignado();
            $asignar_mat->MAS_CANTIDAD = $model->AS_CANTIDAD * $mat->CONS_CANTIDAD;
            $arreglo_mat[]=$asignar_mat;
        }




        if (Model::loadMultiple($arreglo_mat, Yii::$app->request->post()) ) {
            foreach ($arreglo_mat as $material) {
                if($material->MA_ID!=NULL){
                    $material->AS_ID=$model->AS_ID;
                    $material->save();
                    $model->AS_COSTOTOTAL= $model->AS_COSTOTOTAL + ($material->MAS_CANTIDAD*$material->mA->MA_COSTOUNIDAD);
                    $actividad->AC_COSTO_TOTAL= $actividad->AC_COSTO_TOTAL + ($material->MAS_CANTIDAD*$material->mA->MA_COSTOUNIDAD);
                }
            }
            $actividad->save();
            $model->save();
            return $this->redirect(['create', 'id' => $id]);
        }


        return $this->renderAjax('asignar_materiales', [
            'materiales' => $materiales,
            'arreglo_mat' => $arreglo_mat,
            'obreros' => $obreros,
            'model' => $model,
        ]);
    }
    public function actionAsignarHerramientas($id)
    {
        $model= ActSactAsigna::findOne($id);
        $actividad= Actividades::findOne($model->AC_ID);
        $herramientas=SactHeOcupan::find()->where(['SACT_ID'=>$model->SACT_ID])->all();

        $asignados= HerramientaAsignado::find()->where(['AS_ID'=>$model->AS_ID])->all();
        $array_asignados= HerramientaAsignado::find()->select('HE_ID')->where(['AS_ID'=>$model->AS_ID])->asArray()->all();

        $arreglo_he=[new HerramientaAsignado()];
        if ($herramientas!=NULL) {
            foreach ($herramientas as $he) {
                for ($i=0; $i < ($he->OC_CANTIDAD * $model->AS_CANTIDAD); $i++) {
                    /*if ($asignados!=NULL) {
                        foreach ($asignados as $exist) {
                            if($exist->hE->TH_ID == $he->TH_ID){
                                $asignar_he = $exist;
                                $arreglo_he[]=$asignar_he;
                                $i++;
                            }
                        }
                    }else{*/
                        $asignar_he = new HerramientaAsignado();
                        //$asignar_he->HAS_CANTIDAD = $model->AS_CANTIDAD * $he->OC_CANTIDAD;
                        $arreglo_he[]=$asignar_he;
                    //}
                }
            }
        }


        if (Model::loadMultiple($arreglo_he, Yii::$app->request->post()) ) {
            foreach ($arreglo_he as $herramienta) {
                if ($herramienta->HE_ID!=NULL) {
                    $reserva_herramienta= HerramientaTiene::find()->where(['HE_ID'=>$herramienta->HE_ID])->andWhere(['EH_ID'=>5])->one();
                    if($reserva_herramienta!=NULL){
                        $reserva_herramienta->HT_CANTHEESTADO= $reserva_herramienta->HT_CANTHEESTADO + $herramienta->HAS_CANTIDAD;
                        $reserva_herramienta->save();
                    }else{
                        $reserva_he= new HerramientaTiene();
                        $reserva_he->HE_ID= $herramienta->HE_ID;
                        $reserva_he->EH_ID= 5;
                        $reserva_he->HT_CANTHEESTADO= $herramienta->HAS_CANTIDAD;
                        $reserva_he->save();
                    }
                    $herramienta->AS_ID=$model->AS_ID;
                    $herramienta->save();
                    $model->AS_COSTOTOTAL=$model->AS_COSTOTOTAL+($herramienta->HAS_CANTIDAD*$herramienta->hE->HE_COSTOUNIDAD);
                    $actividad->AC_COSTO_TOTAL= $actividad->AC_COSTO_TOTAL + ($herramienta->HAS_CANTIDAD*$herramienta->hE->HE_COSTOUNIDAD);
                }
            }
            $actividad->save();
            $model->save();
            return $this->redirect(['create', 'id' => $model->AC_ID]);
        }


        return $this->renderAjax('asignar_herramientas', [
            'herramientas' => $herramientas,
            'asignados' => $asignados,
            'array_asignados' => $array_asignados,
            'arreglo_he' => $arreglo_he,
            'model' => $model,
        ]);
    }

    public function actionListaHerramienta($id){
        if ($id!=NULL) {
            $herramienta= Herramientas::findOne($id);
            $lista_he= Herramientas::find()->where(['not in', 'HE_ID', $id])->andWhere(['not in', 'TH_ID', $herramienta->TH_ID])->all();
            foreach ($lista_he as $lista) {
                echo "<option value='".$lista->HE_ID."'>".$lista->HE_NOMBRE."</option>";
            }
        }else{
            echo "<option>-</option>";
        }
    }


/*
    public function actionAsignarSubact($id)
    {
        $actividad = Actividades::findOne($id);
        $asignar_subact = [new ActSactAsigna];

        $
        $array_exist_subact = ActSactAsigna::find()->select('SACT_ID')->where(['AC_ID'=>$id])->asArray()->all();
        if ($array_exist_subact) {
            $array_noasig= Subactividades::fin()->select('SACT_ID')->where(['not in','SACT_ID', $array_exist_subact])->asArray()->all();
            $cantidad_subact= Subactividades::find()->where([])->count();
        }else{
            $cantidad_subact= Subactividades::find()->count();            
        }



        if ($actividad->load(Yii::$app->request->post())) {
            //$model->save();
            $asignar_subact = Model::createMultiple(ActSactAsigna::classname());
            Model::loadMultiple($asignar_subact, Yii::$app->request->post());


            // validate all models
            //$valid = $model->validate();
            $valid = Model::validateMultiple($asignar_subact);
            $valid = true;

            if ($valid) {
                //$model->save();
                $transaction = \Yii::$app->db->beginTransaction();
                $orden_compra->save();
                try {
                    if ($flag = $orden_compra->save(false)) {
                        foreach ($asignar_subact as $asignar) {

                            $asignar->AC_ID = $actividad->AC_ID;
                            $asignar->AS_COSTOTOTAL = 0;
                            $asignar->AS_CANTIDADACTUAL = 0;
                            $asignar->AS_COSTOACTUAL = 0;
                            if (! ($flag = $adquisicion->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['orden-trabajo/index-act', 'id' => $actividad->oT->PRO_ID]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }else{
            return $this->render('multi_adq', [
                'actividad' => $actividad,
                'cantidad_subact' => $cantidad_subact,
                'asignar_subact' => (empty($asignar_subact)) ? [new MatOrcAdquirido] : $asignar_subact
            ]);
        }


    }*/

}
