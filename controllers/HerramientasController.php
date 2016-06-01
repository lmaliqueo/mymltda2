<?php

namespace app\controllers;

use Yii;
use app\models\Herramientas;
use app\models\HerramientaTiene;
use app\models\HerramientasSearch;
use app\models\EstadoHerramientas;
use app\models\Bodegas;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * HerramientasController implements the CRUD actions for Herramientas model.
 */
class HerramientasController extends Controller
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
     * Lists all Herramientas models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new HerramientasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Herramientas model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->renderAjax('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Herramientas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Herramientas();
        $herramientatiene= new HerramientaTiene();
        $estadoherramienta= EstadoHerramientas::findOne(1);
        $model->HE_CANT=1;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $herramientatiene->HE_ID = $model->HE_ID;
            $herramientatiene->EH_ID = $estadoherramienta->EH_ID;
            $herramientatiene->HT_CANTHEESTADO = $model->HE_CANT;
            $herramientatiene->save();
            return $this->redirect(['view', 'id' => $model->HE_ID]);
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Herramientas model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->find(Model($id));

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->HE_ID]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Herramientas model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model=$this->findModel($id);
        $herramientatiene= HerramientaTiene::find('HE_ID'==$id)->all();
        if($herramientatiene!=NULL){
            $herramientatiene->delete();
        }
        $model->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Herramientas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Herramientas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Herramientas::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
