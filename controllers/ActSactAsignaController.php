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
        if ($model->load(Yii::$app->request->post())) {
        
            foreach ($asignados as $asig) {
                if($asig->SACT_ID==$model->SACT_ID){
                    return $this->redirect(['create', 'id' => $id]);
                }
            }
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
    public function actionGetCosto($id){
        $subact= Subactividades::findOne($id);
        echo Json::encode($subact);
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
        $materiales= SactMatConsume::find()->where(['SACT_ID'=>$model->SACT_ID])->all();
        $herramientas=SactHeOcupan::find()->where(['SACT_ID'=>$model->SACT_ID])->all();
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
                }
            }
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
        $herramientas=SactHeOcupan::find()->where(['SACT_ID'=>$model->SACT_ID])->all();

        $asignados= HerramientaAsignado::find()->where(['AS_ID'=>$model->AS_ID])->all();

        $arreglo_he=[new HerramientaAsignado()];
        if ($herramientas!=NULL) {
            foreach ($herramientas as $he) {
                for ($i=0; $i < ($he->OC_CANTIDAD * $model->AS_CANTIDAD); $i++) {
                    if ($asignados!=NULL) {
                        foreach ($asignados as $exist) {
                            if($exist->hE->TH_ID == $he->TH_ID){
                                $asignar_he = $exist;
                                $arreglo_he[]=$asignar_he;
                                $i++;
                            }
                        }
                    }else{
                        $asignar_he = new HerramientaAsignado();
                        //$asignar_he->HAS_CANTIDAD = $model->AS_CANTIDAD * $he->OC_CANTIDAD;
                        $arreglo_he[]=$asignar_he;
                    }
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
                }
            }
            $model->save();
            return $this->redirect(['create', 'id' => $id]);
        }


        return $this->renderAjax('asignar_herramientas', [
            'herramientas' => $herramientas,
            'arreglo_he' => $arreglo_he,
            'model' => $model,
        ]);
    }
}
