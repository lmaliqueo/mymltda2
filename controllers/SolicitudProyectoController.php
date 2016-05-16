<?php

namespace app\controllers;

use Yii;
use app\models\SolicitudProyecto;
use app\models\SolicitudProyectoSearch;
use app\models\Proyecto;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SolicitudProyectoController implements the CRUD actions for SolicitudProyecto model.
 */
class SolicitudProyectoController extends Controller
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
     * Lists all SolicitudProyecto models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SolicitudProyectoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SolicitudProyecto model.
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
     * Creates a new SolicitudProyecto model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SolicitudProyecto();

        if ($model->load(Yii::$app->request->post())) {
            $model->SPRO_ESTADO='Pendiente';
            $model->save();
            return $this->redirect(['view', 'id' => $model->SPRO_ID]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing SolicitudProyecto model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->SPRO_ID]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing SolicitudProyecto model.
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
     * Finds the SolicitudProyecto model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SolicitudProyecto the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SolicitudProyecto::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    public function actionAprobar($id){
        $model=$this->findModel($id);
        $proyecto=new Proyecto();
        if($model->SPRO_ESTADO!='Pendiente'){
                Yii::app()->user->setFlash('error','Esta solicitud ya fue evaluada');
            return $this->redirect(['index']);

        }else{
            $model->SPRO_ESTADO='Aprobado';
            $proyecto->SPRO_ID=$model->SPRO_ID;
            $proyecto->PRO_ESTADO='Pendiente';
            $proyecto->PRO_NOMBRE=$model->SPRO_NOMBRE;
            $proyecto->PRO_TIPOCONTRATO=$model->SPRO_MONTOAOFRECER;
            if($model->save()){
                if($proyecto->save())
                Yii::app()->user->setFlash('success','La solicitud fue aprobada con éxito');                
            }
            return $this->redirect(['index']);

        }

    }


    public function actionRechazar($id){
        $model=$this->findModel($id);
        if($model->SPRO_ESTADO!='Pendiente'){
                Yii::app()->user->setFlash('error','Esta solicitud ya fue evaluada');
            return $this->redirect(['index']);

        }else{
            $model->SPRO_ESTADO='Rechazado';
            if($model->save())
                Yii::app()->user->setFlash('success','La solicitud fue rechazado');             
        }
            return $this->redirect(['index']);

    }


}
