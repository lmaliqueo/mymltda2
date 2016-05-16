<?php

namespace app\controllers;

use Yii;
use app\models\Materiales;
use app\models\MaterialesSearch;
use app\models\BoMatAlmacena;
use app\models\StockMateriales;
use app\models\TransaccionMateriales;
use app\models\MatProvAdquirido;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MaterialesController implements the CRUD actions for Materiales model.
 */
class MaterialesController extends Controller
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
     * Lists all Materiales models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MaterialesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Materiales model.
     * @param integer $id
     * @return mixed
     */

    public function actionView($id)
    {

        $almacena= BoMatAlmacena::find()->where('MA_ID=:x',[':x'=>$id])->all();
        $stock= StockMateriales::find()->where('MA_ID=:x',[':x'=>$id])->all();

        $idstock= StockMateriales::find()->where(['MA_ID' => $id])->asArray()->all();
        $transaccion= TransaccionMateriales::find()->where(['CM_ID'=>$idstock])->asArray()->all();
        $adquirido= MatProvAdquirido::find()->where(['TM_ID'=>$transaccion])->all();

        return $this->render('view', [
            'model' => $this->findModel($id),
            'almacena' => $almacena,
            'stock' => $stock,
            'adquirido' => $adquirido,
        ]);
    }

    /**
     * Creates a new Materiales model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Materiales();

        if ($model->load(Yii::$app->request->post())) {
            $model->MA_CANTIDADTOTAL=0;
            $model->save();
            return $this->redirect(['view', 'id' => $model->MA_ID]);
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Materiales model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->MA_ID]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Materiales model.
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
     * Finds the Materiales model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Materiales the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Materiales::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
