<?php

namespace app\controllers;

use Yii;
use app\models\Materiales;
use app\models\MaterialesSearch;
use app\models\StockMaterialesSearch;
use app\models\BoMatAlmacena;
use app\models\StockMateriales;
use app\models\Proyecto;
use app\models\OrdenTrabajo;
use app\models\PedidoAdjunta;
use app\models\TransaccionMateriales;
use app\models\MatProvAdquirido;
use app\models\CantidadUtilizada;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;

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

        return $this->renderAjax('view', [
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

    public function actionMaterialesPro($id)
    {
        $proyecto = Proyecto::findOne($id);
        $array_ot = OrdenTrabajo::find()->select('OT_ID')->where(['PRO_ID'=>$proyecto->PRO_ID])->asArray()->all();
        $stock = StockMateriales::find()->where(['OT_ID'=>$array_ot])->all();



        $searchModel = new StockMaterialesSearch();
        $dataProvider = new ActiveDataProvider([
            'query' => StockMateriales::find()->
                where(['OT_ID'=>$array_ot]),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        return $this->render('index_pro', [
            'proyecto' => $proyecto,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionTransaccionesPro($id)
    {
        $proyecto = Proyecto::findOne($id);
        $array_ot = OrdenTrabajo::find()->select('OT_ID')->where(['PRO_ID'=>$id])->asArray()->all();
        $array_stock = StockMateriales::find()->select('SM_ID')->where(['OT_ID'=>$array_ot])->asArray()->all();
        $array_trans = TransaccionMateriales::find()->select('TM_ID')->where(['SM_ID'=>$array_stock])->asArray()->all();
        $transacciones = MatProvAdquirido::find()->where(['TM_ID'=>$array_trans])->all();
        return $this->renderAjax('transacciones_pro', [
            'proyecto'=>$proyecto,
            'transacciones'=>$transacciones,
        ]);
    }

    public function actionMovimientosPro($id)
    {
        $proyecto = Proyecto::findOne($id);
        $array_ot = OrdenTrabajo::find()->select('OT_ID')->where(['PRO_ID'=>$id])->asArray()->all();
        $array_stock = StockMateriales::find()->select('SM_ID')->where(['OT_ID'=>$array_ot])->asArray()->all();
        $utilizados = CantidadUtilizada::find()->where(['SM_ID'=>$array_stock])->all();
        $transacciones = TransaccionMateriales::find()->where(['SM_ID'=>$array_stock])->all();

        return $this->renderAjax('movimientos_pro', [
            'proyecto'=>$proyecto,
            'transacciones'=>$transacciones,
            'utilizados'=>$utilizados,
        ]);
    }
    public function actionBodegaPro($id)
    {
        $proyecto = Proyecto::findOne($id);
        $array_ot = OrdenTrabajo::find()->select('OT_ID')->where(['PRO_ID'=>$id])->asArray()->all();
        $array_mat = StockMateriales::find()->select('MA_ID')->where(['OT_ID'=>$array_ot])->asArray()->all();
        $materiales = BoMatAlmacena::find()->where(['MA_ID'=>$array_mat])->all();
        return $this->renderAjax('bodega_pro', [
            'proyecto'=>$proyecto,
            'materiales'=>$materiales,
        ]);
    }

    public function actionPedidosPro($id)
    {
        $proyecto = Proyecto::findOne($id);
        $array_ot = OrdenTrabajo::find()->select('OT_ID')->where(['PRO_ID'=>$id])->asArray()->all();
        $array_stock = StockMateriales::find()->select('SM_ID')->where(['OT_ID'=>$array_ot])->asArray()->all();
        $pedidos = PedidoAdjunta::find()->where(['SM_ID'=>$array_stock])->all();
        return $this->renderAjax('pedidos_pro', [
            'proyecto'=>$proyecto,
            'pedidos'=>$pedidos,
        ]);
    }

    public function actionCrearTransaccion($id)
    {
        $model=new MatProvAdquirido();
        $transaccion=new TransaccionMateriales();
        $almacena=new BoMatAlmacena();
        $stock=new StockMateriales();
        $ordenes_trabajos= OrdenTrabajo::find()->where(['PRO_ID'=>$id])->all();

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
            return $this->renderAjax('form_trans', [
                'model' => $model,
                'almacena'=>$almacena,
                'transaccion'=>$transaccion,
                'stock'=>$stock,
                'ordenes_trabajos'=>$ordenes_trabajos,
           ]);
        }
    }
}
