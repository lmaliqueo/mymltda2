<?php

namespace app\controllers;

use Yii;
use app\models\MatProvAdquirido;
use app\models\MatProvAdquiridoSearch;
use app\models\TransaccionMateriales;
use app\models\BoMatAlmacena;
use app\models\StockMateriales;
use app\models\Materiales;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;

/**
 * MatProvAdquiridoController implements the CRUD actions for MatProvAdquirido model.
 */
class MatProvAdquiridoController extends Controller
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
     * Lists all MatProvAdquirido models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MatProvAdquiridoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MatProvAdquirido model.
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
     * Creates a new MatProvAdquirido model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MatProvAdquirido();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->AD_ID]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing MatProvAdquirido model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->AD_ID]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing MatProvAdquirido model.
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
     * Finds the MatProvAdquirido model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MatProvAdquirido the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MatProvAdquirido::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionTransaccion()
    {
        $model=new MatProvAdquirido();
        $transaccion=new TransaccionMateriales();
        $almacena=new BoMatAlmacena();
        $stock=new StockMateriales();

        // Uncomment the following line if AJAX validation is needed
        //$this->performAjaxValidation($model);
        if ($model->load(Yii::$app->request->post())) {

            $transaccion->load(Yii::$app->request->post());
            $stock->load(Yii::$app->request->post());
            $almacena->load(Yii::$app->request->post());

            $transaccion->TM_FECHACOMPRA=date('Y-m-d');

            $valid= $model->validate();

            $material= Materiales::findOne($model->MA_ID);

            $almacena_existe= BoMatAlmacena::find()->where('BO_ID=:x AND MA_ID=:y',[':x'=>$almacena->BO_ID, ':y'=>$model->MA_ID])->one();


            $stock_existente= StockMateriales::find()->where('OT_ID=:x AND MA_ID=:y',[':x'=>$stock->OT_ID, ':y'=>$model->MA_ID])->one();

            if($valid){

                if($almacena_existe!=NULL){
                    $almacena_existe->AL_CANTMATERIALES=$almacena->AL_CANTMATERIALES+$transaccion->TM_CANTIDAD;
                    $almacena_existe->save();
                }else{
                    $almacena->MA_ID = $material->MA_ID;
                    $almacena->AL_CANTMATERIALES=$transaccion->TM_CANTIDAD;
                    $almacena->save();
                }

                $material->MA_CANTIDADTOTAL=$material->MA_CANTIDADTOTAL+$transaccion->TM_CANTIDAD;
                $material->save();



                if($stock_existente!=NULL){
                    $stock_existente->SM_CANTIDAD=$stock_existente->SM_CANTIDAD+$transaccion->TM_CANTIDAD;
                    $stock_existente->save();
                    $transaccion->SM_ID=$stock_existente->SM_ID;
                }else{
                    $stock->SM_CANTIDAD=$transaccion->TM_CANTIDAD;
                    $stock->MA_ID=$material->MA_ID;
                    $stock->SM_ESTADO='En reserva';
                    $stock->save();                  
                    $transaccion->SM_ID=$stock->SM_ID;
                }



                $transaccion->save();
                $model->TM_ID = $transaccion->TM_ID;
                $model->save();

            return $this->redirect(['materiales/index']);

            }

        } else {
            return $this->renderAjax('create', [
                'model' => $model,
                'almacena'=>$almacena,
                'transaccion'=>$transaccion,
                'stock'=>$stock,
           ]);
        }
    }
    public function actionGetCosto($id){
        $material= Materiales::findOne($id);
        echo Json::encode($material);
    }
    public function actionGetCostoTotal($cantidad, $id){
        $material= Materiales::findOne($id);

        $costototal= $cantidad*$material->MA_COSTOUNIDAD;
        echo $costototal;
    }

}
