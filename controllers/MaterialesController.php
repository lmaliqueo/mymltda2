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
use app\models\OrdenCompra;
use app\models\PedidoAdjunta;
use app\models\TransaccionMateriales;
use app\models\MatOrcAdquirido;
use app\models\CantidadUtilizada;
use app\models\OrdenDespacho;
use app\models\OdMatEspecifica;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use app\models\Model;

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
        $adquirido= MatOrcAdquirido::find()->where(['SM_ID'=>$idstock])->all();

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

    public function actionAdquisicionPro($id)
    {
        $proyecto = Proyecto::findOne($id);
        $array_ot = OrdenTrabajo::find()->select('OT_ID')->where(['PRO_ID'=>$id])->asArray()->all();
        $array_stock = StockMateriales::find()->select('SM_ID')->where(['OT_ID'=>$array_ot])->asArray()->all();
        $adquisicion = MatOrcAdquirido::find()->where(['SM_ID'=>$array_stock])->all();
        return $this->renderAjax('adquisiciones_pro', [
            'proyecto'=>$proyecto,
            'adquisicion'=>$adquisicion,
        ]);
    }

    public function actionMovimientosPro($id)
    {
        $proyecto = Proyecto::findOne($id);
        $array_ot = OrdenTrabajo::find()->select('OT_ID')->where(['PRO_ID'=>$id])->asArray()->all();
        $array_stock = StockMateriales::find()->select('SM_ID')->where(['OT_ID'=>$array_ot])->asArray()->all();
        $utilizados = CantidadUtilizada::find()->where(['SM_ID'=>$array_stock])->all();
        $adquiridos = MatOrcAdquirido::find()->where(['SM_ID'=>$array_stock])->all();

        return $this->renderAjax('movimientos_pro', [
            'proyecto'=>$proyecto,
            'adquiridos'=>$adquiridos,
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
        $model=new MatOrcAdquirido();
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
    public function actionIngresarAdquisiciones($id)
    {
        $proyecto = Proyecto::findOne($id);
        $ordenes_trabajos = OrdenTrabajo::find()->where(['PRO_ID'=>$id])->all();
        $stock = new StockMateriales();
        $model = new MatOrcAdquirido();
        $adquisiciones= [new MatOrcAdquirido];

        $cant_materiales = Materiales::find()->count();

/*------------------------------------------ORDEN_COMPRA---------------------------------------*/
        $array_ot = OrdenTrabajo::find()->select('OT_ID')->where(['PRO_ID'=>$id])->asArray()->all();
        $array_stock = StockMateriales::find()->select('SM_ID')->where(['OT_ID'=>$array_ot])->asArray()->all();
        $array_adq = MatOrcAdquirido::find()->select('ORC_ID')->where(['SM_ID'=>$id])->asArray()->all();
        $numero_orc = OrdenCompra::find()->where(['ORC_ID'=>$id])->count();
        $orden_compra= new OrdenCompra();
        $orden_compra->ORC_COSTO_TOTAL=0;
        $orden_compra->ORC_FECHA_PEDIDO = date('Y-m-d');
        $orden_compra->ORC_NUMERO_ORDEN = $numero_orc+1;
/*------------------------------------------ORDEN_COMPRA---------------------------------------*/

        $model->AD_FECHA= date('Y-m-d');
        if ($model->load(Yii::$app->request->post()) and $stock->load(Yii::$app->request->post()) and $orden_compra->load(Yii::$app->request->post())) {
            //$model->save();
            $adquisiciones = Model::createMultiple(MatOrcAdquirido::classname());
            Model::loadMultiple($adquisiciones, Yii::$app->request->post());

            $orden_compra->save();

            // validate all models
            //$valid = $model->validate();
            $valid = Model::validateMultiple($adquisiciones);

            if ($valid) {
                //$model->save();
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $orden_compra->save(false)) {
                        foreach ($adquisiciones as $adquisicion) {
                            $adquisicion->BO_ID = $model->BO_ID;


                            /*------------------------------------------BODEGA---------------------------------------*/
                            if($model->BO_ID != NULL){
                                $almacena_exist = BoMatAlmacena::find()
                                    ->where(['OT_ID'=>$stock->OT_ID])
                                    ->andWhere(['BO_ID'=>$model->BO_ID])
                                    ->andWhere(['MA_ID'=>$adquisicion->MA_ID])
                                    ->one();
                                if ($almacena_exist!=NULL) {
                                    $almacena_exist->AL_CANTIDAD= $almacena_exist->AL_CANTIDAD + $adquisicion->AD_CANTIDAD;
                                    $almacena_exist->save();
                                }else{
                                    $almacena_new = new BoMatAlmacena();
                                    $almacena_new->MA_ID = $adquisicion->MA_ID;
                                    $almacena_new->BO_ID = $model->BO_ID;
                                    $almacena_new->AL_CANTIDAD = $adquisicion->AD_CANTIDAD;
                                    $almacena_new->OT_ID = $stock->OT_ID;
                                    $almacena_new->save();
                                }
                            }
                            /*------------------------------------------BODEGA---------------------------------------*/

                            /*------------------------------------------STOCK---------------------------------------*/

                            $stock_exist= StockMateriales::find()->where(['OT_ID'=>$stock->OT_ID])->andWhere(['MA_ID'=>$adquisicion->MA_ID])->one();
                            if($stock_exist!=NULL){
                                $stock_exist->SM_CANTIDAD = $stock_exist->SM_CANTIDAD + $adquisicion->AD_CANTIDAD;
                                $stock_exist->save();
                                $adquisicion->SM_ID = $stock_exist->SM_ID;
                            }else{
                                $stock_new = new StockMateriales();
                                $stock_new->MA_ID=$adquisicion->MA_ID;
                                $stock_new->OT_ID = $stock->OT_ID;
                                $stock_new->SM_CANTIDAD= $adquisicion->AD_CANTIDAD;
                                $stock_new->save();
                                $adquisicion->SM_ID = $stock_new->SM_ID;
                            }

                            /*------------------------------------------STOCK---------------------------------------*/

                            /*------------------------------------------ADQUISICION---------------------------------------*/

                            $adquisicion->BO_ID= $model->BO_ID;
                            $adquisicion->AD_FECHA = $model->AD_FECHA;
                            $adquisicion->ORC_ID = $orden_compra->ORC_ID;
                            $orden_compra->ORC_COSTO_TOTAL = $orden_compra->ORC_COSTO_TOTAL + $adquisicion->AD_COSTO_TOTAL;
                            /*------------------------------------------ADQUISICION---------------------------------------*/

                            if (! ($flag = $adquisicion->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->SPRE_ID]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
            $orden_compra->save();
        }else{
            return $this->renderAjax('multi_adq', [
                'ordenes_trabajos' => $ordenes_trabajos,
                'stock' => $stock,
                'model' => $model,
                'cant_materiales' => $cant_materiales,
                'proyecto' => $proyecto,
                'orden_compra' => $orden_compra,
                'adquisiciones' => (empty($adquisiciones)) ? [new MatOrcAdquirido] : $adquisiciones
            ]);
        }
    }


    public function actionCrearDespachoMat($id)
    {
        $proyecto=Proyecto::findOne($id);
        $orden_despacho= new OrdenDespacho();
        $despachos=[new OdMatEspecifica];
        $ordenes_trabajos = OrdenTrabajo::find()->where(['PRO_ID'=>$id])->all();

        $model = new BoMatAlmacena();

        $array_ot = OrdenTrabajo::find()->select('OT_ID')->where(['PRO_ID'=>$id])->asArray()->all();
        $array_alm = BoMatAlmacena::find()->select('AL_ID')->where(['OT_ID'=>$array_ot])->asArray()->all();
        $array_despachos= OdMatEspecifica::find()->select('OD_ID')->where(['AL_ID'=>$array_alm])->asArray()->all();

        $cantidad_od= OrdenDespacho::find()->where(['OD_ID'=>$array_alm])->count();

        $orden_despacho->OD_FECHA_EMISION= date('Y-m-d');
        $orden_despacho->OD_NUMERO_ORDEN = $cantidad_od+1;

        $almacenados= new BoMatAlmacena();

        if ($orden_despacho->load(Yii::$app->request->post())) {
            $despachos = Model::createMultiple(MatOrcAdquirido::classname());
            Model::loadMultiple($despachos, Yii::$app->request->post());

            $valid = $model->validate();
            $valid = Model::validateMultiple($despachos) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        foreach ($despachos as $despacho) {


                            /*---------------------------------------------------BODEGA---------------------------------------------------*/
                            $mat_almacenado= BoMatAlmacena::findOne($despacho->AL_ID);
                            $mat_almacenado->AL_CANTIDAD = $mat_almacenado->AL_CANTIDAD - $despacho->ESP_CANTIDAD_DESPACHO;
                            $mat_almacenado->save();
                            /*---------------------------------------------------BODEGA---------------------------------------------------*/


                            /*---------------------------------------------------STOCK---------------------------------------------------*/
                            $stock_mat = StockMateriales::find()->where(['OT_ID'=>$mat_almacenado->OT_ID])->andWhere(['MA_ID'=>$mat_almacenado->MA_ID])->one();
                            $stock_mat->SM_CANTIDAD = $stock_mat->SM_CANTIDAD + $despacho->ESP_CANTIDAD_DESPACHO;
                            $stock_mat->save();
                            /*---------------------------------------------------STOCK---------------------------------------------------*/

                            /*---------------------------------------------------DESPACHO---------------------------------------------------*/
                            $despacho->OD_ID = $orden_despacho->OD_ID;
                            if (! ($flag = $despacho->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                            /*---------------------------------------------------DESPACHO---------------------------------------------------*/
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view_orden_desp', 'id' => $orden_despacho->OD_ID]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }

            }


        }else{
            return $this->renderAjax('_form_despacho', [
                'ordenes_trabajos' => $ordenes_trabajos,
                'orden_despacho' => $orden_despacho,
                'almacenados' => $almacenados,
                'proyecto' => $proyecto,
                'model' => $model,
                'despachos' => (empty($despachos)) ? [new OdMatEspecifica] : $despachos
            ]);
        }
    }

    public function actionListaMateriales($id)
    {
        $array_almacenados = BoMatAlmacena::find()->select('MA_ID')->where(['OT_ID'=>$id])->asArray()->all();
        $materiales = Materiales::find()->where(['MA_ID'=>$array_almacenados])->all();
        if ($materiales!=NULL) {
            echo "<option value='".$materiales->MA_ID."'>".$materiales->MA_NOMBRE."</option>";
        }
        else{
            echo "<option>-</option>";
        }
    }

    public function actionListaNoIncluidos($array_mat)
    {
        $materiales = Materiales::find()->where(['not in','MA_ID',$array_mat])->all();
        $materiales_full = Materiales::find()->all();
        if ($materiales!=NULL) {
            echo "<option value='".$materiales->MA_ID."'>".$materiales->MA_NOMBRE."</option>";
        }
        else{
            echo "<option value='".$materiales_full->MA_ID."'>".$materiales_full->MA_NOMBRE."</option>";
        }
    }

}
