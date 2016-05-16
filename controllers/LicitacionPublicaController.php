<?php

namespace app\controllers;

use Yii;
use app\models\LicitacionPublica;
use app\models\LicitacionPublicaSearch;
use app\models\Proyecto;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * LicitacionPublicaController implements the CRUD actions for LicitacionPublica model.
 */
class LicitacionPublicaController extends Controller
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
     * Lists all LicitacionPublica models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new LicitacionPublicaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single LicitacionPublica model.
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
     * Creates a new LicitacionPublica model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new LicitacionPublica();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->LI_ID]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing LicitacionPublica model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->LI_ESTADO='Pendiente';
            $model->save();
            return $this->redirect(['view', 'id' => $model->LI_ID]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing LicitacionPublica model.
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
     * Finds the LicitacionPublica model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return LicitacionPublica the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = LicitacionPublica::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionAprobar($id){
        $model=$this->findModel($id);
        $proyecto=new Proyecto();
        if($model->LI_ESTADO!='Pendiente'){
                Yii::app()->user->setFlash('error','Esta licitacion ya fue evaluada');
            return $this->redirect(['index']);

        }else{
            $model->LI_ESTADO='Aprobado';
            $proyecto->LI_ID=$model->LI_ID;
            $proyecto->PRO_ESTADO='Pendiente';
            $proyecto->PRO_NOMBRE=$model->LI_DESCRIPCION;
            if($model->save()){
                if($proyecto->save())
                Yii::app()->user->setFlash('success','La licitacion fue aprobada con éxito');               
            }
            return $this->redirect(['index']);

        }

    }


    public function actionRechazar($id){
        $model=$this->findModel($id);
        if($model->LI_ESTADO!='Pendiente'){
                Yii::app()->user->setFlash('error','Esta licitacion ya fue evaluada');
            return $this->redirect(['index']);

        }else{
            $model->LI_ESTADO='Rechazado';
            if($model->save())
                Yii::app()->user->setFlash('success','La licitacion fue rechazado');                
        }
        return $this->redirect(['index']);

    }
}
