<?php

namespace app\controllers;

use Yii;
use app\models\Materiales;
use app\models\MaterialesSearch;
use app\models\StockMaterialesSearch;
use app\models\BoMatAlmacena;
use app\models\StockMateriales;
use app\models\Proyecto;
use app\models\Bodegas;
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
use yii\helpers\Json;

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
        $ordentrabajo = OrdenTrabajo::findOne($id);
        $stock = StockMateriales::find()->where(['OT_ID'=>$id])->all();



        $searchModel = new StockMaterialesSearch();
        $dataProvider = new ActiveDataProvider([
            'query' => StockMateriales::find()->
                where(['OT_ID'=>$id]),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        return $this->render('index_pro', [
            'ordentrabajo' => $ordentrabajo,
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
/*########################################################################################################################*/
/*###################################################### MOVIMIENTOS-MAT ######################################################*/
/*########################################################################################################################*/

    public function actionMovimientosPro($id)
    {
        $proyecto = Proyecto::findOne($id);
        $array_ot = OrdenTrabajo::find()->select('OT_ID')->where(['PRO_ID'=>$id])->asArray()->all();
        $array_oc = OrdenCompra::find()->select('ORC_ID')->where(['ORC_ESTADO'=>'Autorizado'])->asArray()->all();
        $array_stock = StockMateriales::find()->select('SM_ID')->where(['OT_ID'=>$array_ot])->asArray()->all();
        $utilizados = CantidadUtilizada::find()->where(['SM_ID'=>$array_stock])->all();
        $adquiridos = MatOrcAdquirido::find()->where(['SM_ID'=>$array_stock])->andWhere(['ORC_ID'=>$array_oc])->all();


        $array_mat = MatOrcAdquirido::find()->select('MA_ID')->where(['SM_ID'=>$array_stock])->andWhere(['ORC_ID'=>$array_oc])->asArray()->all();

        $materiales = Materiales::find()->where(['MA_ID'=>$array_mat])->all();

        $orden_trabajo = OrdenTrabajo::find()->where(['PRO_ID'=>$id])->all();


        return $this->renderAjax('movimientos_pro', [
            'proyecto'=>$proyecto,
            'adquiridos'=>$adquiridos,
            'utilizados'=>$utilizados,
            'orden_trabajo'=>$orden_trabajo,
            'materiales'=>$materiales,
        ]);
    }

    public function actionBuscarMovMat($idpro, $idmat, $idot, $fecha_f, $fecha_i)
    {
        $array_oc = OrdenCompra::find()->select('ORC_ID')->where(['ORC_ESTADO'=>'Autorizado'])->asArray()->all();

        if ($idot!=NULL) {
            if ($idmat!=NULL) {
                $array_stock = StockMateriales::find()->select('SM_ID')->where(['OT_ID'=>$idot])->andWhere(['MA_ID'=>$idmat])->asArray()->all();
            }else{
                $array_stock = StockMateriales::find()->select('SM_ID')->where(['OT_ID'=>$idot])->asArray()->all();            
            }
        }else{
            $array_ot = OrdenTrabajo::find()->select('OT_ID')->where(['PRO_ID'=>$idpro])->asArray()->all();
            if ($idmat!=NULL) {
                $array_stock = StockMateriales::find()->select('SM_ID')->where(['OT_ID'=>$array_ot])->andWhere(['MA_ID'=>$idmat])->asArray()->all();
            }else{
                $array_stock = StockMateriales::find()->select('SM_ID')->where(['OT_ID'=>$array_ot])->asArray()->all();
            }
        }

        $adquiridos = MatOrcAdquirido::find()
                        ->where(['SM_ID'=>$array_stock])
                        ->andWhere(['ORC_ID'=>$array_oc])
                        ->andWhere('AD_FECHA<=:fecha_f and AD_FECHA>=:fecha_i',[':fecha_i'=>$fecha_i, ':fecha_f'=>$fecha_f])
                        ->all();
        $utilizados = CantidadUtilizada::find()->where(['SM_ID'=>$array_stock])->all();


        return $this->renderAjax('tabla_mov_mat', [
            'adquiridos'=>$adquiridos,
            'utilizados'=>$utilizados,
        ]);
    }

/*########################################################################################################################*/
/*###################################################### MOVIMIENTOS-MAT ######################################################*/
/*########################################################################################################################*/


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

    public function actionIndexPedidos()
    {
        $array_ot = OrdenTrabajo::find()->select('OT_ID')->asArray()->all();
        $array_stock = StockMateriales::find()->select('SM_ID')->where(['OT_ID'=>$array_ot])->asArray()->all();
        $pedidos = PedidoAdjunta::find()->where(['SM_ID'=>$array_stock])->all();
        return $this->renderAjax('index_pedidos', [
            'pedidos'=>$pedidos,
        ]);
    }



/*########################################################################################################################*/
/*###################################################### ORDEN-COMPRA ######################################################*/
/*########################################################################################################################*/


    public function actionOrdenCompraIndex()
    {
        $ordenes_compra = OrdenCompra::find()->all();
        $envio=[];
        if ($ordenes_compra!=NULL) {
            foreach ($ordenes_compra as $count => $compra) {
                $bodega = MatOrcAdquirido::find()->where(['ORC_ID'=>$compra->ORC_ID])->one();
                if ($bodega->BO_ID != NULL) {
                    $envio[] = $bodega->bO->BO_NOMBRE;
                }else{
                    $envio[] = 'Obra';
                }
            }
        }



        return $this->render('index_ordencompra', [
            'ordenes_compra'=>$ordenes_compra,
            'envio'=>$envio,
        ]);        
    }

    public function actionIngresarOrdenCompra()
    {
        $ordenes_trabajos = OrdenTrabajo::find()->where(['not in','OT_ESTADO', 'Finalizado'])->all();
        $stock = new StockMateriales();
        $model = new BoMatAlmacena();
        $adquisiciones= [new MatOrcAdquirido];

        $cant_materiales = Materiales::find()->count();

/*------------------------------------------ORDEN_COMPRA---------------------------------------*/
        $orden_compra= new OrdenCompra();
        $orden_compra->ORC_COSTO_TOTAL=0;
        $orden_compra->ORC_FECHA_PEDIDO = date('Y-m-d');
        $orden_compra->ORC_ESTADO = 'Pendiente';
        $costo_total=0;
/*------------------------------------------ORDEN_COMPRA---------------------------------------*/

        //$model->AD_FECHA= date('Y-m-d');
        if ($model->load(Yii::$app->request->post()) and $orden_compra->load(Yii::$app->request->post())) {
            //$model->save();
            $adquisiciones = Model::createMultiple(MatOrcAdquirido::classname());
            Model::loadMultiple($adquisiciones, Yii::$app->request->post());


            // validate all models
            //$valid = $model->validate();
            $valid = Model::validateMultiple($adquisiciones);
            $valid = true;

            if ($valid) {
                //$model->save();
                $transaction = \Yii::$app->db->beginTransaction();
                $orden_compra->save();
                try {
                    if ($flag = $orden_compra->save(false)) {
                        foreach ($adquisiciones as $adquisicion) {



                            /*------------------------------------------STOCK---------------------------------------*/

                            $stock_exist= StockMateriales::find()->where(['OT_ID'=>$orden_compra->OT_ID])->andWhere(['MA_ID'=>$adquisicion->MA_ID])->one();
                            if($stock_exist!=NULL){
                                $adquisicion->SM_ID = $stock_exist->SM_ID;
                            }else{
                                $stock_new = new StockMateriales();
                                $stock_new->MA_ID=$adquisicion->MA_ID;
                                $stock_new->OT_ID = $orden_compra->OT_ID;
                                $stock_new->SM_CANTIDAD= 0;
                                $stock_new->save();
                                $adquisicion->SM_ID = $stock_new->SM_ID;
                                //return $adquisicion->SM_ID.''.$stock_new->SM_ID;
                            }

                            /*------------------------------------------STOCK---------------------------------------*/

                            /*------------------------------------------ADQUISICION---------------------------------------*/

                            $adquisicion->BO_ID= $model->BO_ID;
                            $adquisicion->AD_FECHA = date('Y-m-d');
                            $adquisicion->ORC_ID = $orden_compra->ORC_ID;
                            $material = Materiales::findOne($adquisicion->MA_ID);
                            $adquisicion->AD_COSTO_TOTAL= $adquisicion->AD_CANTIDAD * $material->MA_COSTOUNIDAD;
                            $costo_total = $costo_total + $adquisicion->AD_COSTO_TOTAL;
                            /*------------------------------------------ADQUISICION---------------------------------------*/

                            if (! ($flag = $adquisicion->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $orden_compra1 = OrdenCompra::findOne($orden_compra->ORC_ID);


                        $array_ot = OrdenTrabajo::find()->select('OT_ID')->where(['PRO_ID'=>$orden_compra1->ot->PRO_ID])->asArray()->all();
                        $array_stock = StockMateriales::find()->select('SM_ID')->where(['OT_ID'=>$array_ot])->asArray()->all();
                        $array_adq = MatOrcAdquirido::find()->select('ORC_ID')->where(['SM_ID'=>$array_stock])->asArray()->all();
                        $numero_orc = OrdenCompra::find()->where(['ORC_ID'=>$array_adq])->count();

                        $orden_compra1->ORC_NUMERO_ORDEN = $numero_orc+1;



                        $orden_compra1->ORC_COSTO_TOTAL=$costo_total;
                        $orden_compra1->save();
                        $transaction->commit();
                        return $this->redirect(['materiales-pro', 'id' => $proyecto->PRO_ID]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }else{
            return $this->render('_form_compra', [
                'ordenes_trabajos' => $ordenes_trabajos,
                'model' => $model,
                'cant_materiales' => $cant_materiales,
                'orden_compra' => $orden_compra,
                'adquisiciones' => (empty($adquisiciones)) ? [new MatOrcAdquirido] : $adquisiciones
            ]);
        }
    }


    public function actionIngresarAdquisiciones($id)
    {
        $proyecto = Proyecto::findOne($id);
        $ordenes_trabajos = OrdenTrabajo::find()->where(['PRO_ID'=>$id])->all();
        $stock = new StockMateriales();
        $model = new BoMatAlmacena();
        $adquisiciones= [new MatOrcAdquirido];

        $cant_materiales = Materiales::find()->count();

/*------------------------------------------ORDEN_COMPRA---------------------------------------*/
        $array_ot = OrdenTrabajo::find()->select('OT_ID')->where(['PRO_ID'=>$id])->asArray()->all();
        $array_stock = StockMateriales::find()->select('SM_ID')->where(['OT_ID'=>$array_ot])->asArray()->all();
        $array_adq = MatOrcAdquirido::find()->select('ORC_ID')->where(['SM_ID'=>$id])->asArray()->all();
        $numero_orc = OrdenCompra::find()->where(['ORC_ID'=>$array_adq])->count();
        $orden_compra= new OrdenCompra();
        $orden_compra->ORC_COSTO_TOTAL=0;
        $orden_compra->ORC_FECHA_PEDIDO = date('Y-m-d');
        $orden_compra->ORC_NUMERO_ORDEN = $numero_orc+1;
        $orden_compra->ORC_ESTADO = 'Pendiente';
        $costo_total=0;
/*------------------------------------------ORDEN_COMPRA---------------------------------------*/

        //$model->AD_FECHA= date('Y-m-d');
        if ($model->load(Yii::$app->request->post()) and $orden_compra->load(Yii::$app->request->post())) {
            //$model->save();
            $adquisiciones = Model::createMultiple(MatOrcAdquirido::classname());
            Model::loadMultiple($adquisiciones, Yii::$app->request->post());


            // validate all models
            //$valid = $model->validate();
            $valid = Model::validateMultiple($adquisiciones);
            $valid = true;

            if ($valid) {
                //$model->save();
                $transaction = \Yii::$app->db->beginTransaction();
                $orden_compra->save();
                try {
                    if ($flag = $orden_compra->save(false)) {
                        foreach ($adquisiciones as $adquisicion) {



                            /*------------------------------------------STOCK---------------------------------------*/

                            $stock_exist= StockMateriales::find()->where(['OT_ID'=>$orden_compra->OT_ID])->andWhere(['MA_ID'=>$adquisicion->MA_ID])->one();
                            if($stock_exist!=NULL){
                                $adquisicion->SM_ID = $stock_exist->SM_ID;
                            }else{
                                $stock_new = new StockMateriales();
                                $stock_new->MA_ID=$adquisicion->MA_ID;
                                $stock_new->OT_ID = $orden_compra->OT_ID;
                                $stock_new->SM_CANTIDAD= 0;
                                $stock_new->save();
                                $adquisicion->SM_ID = $stock_new->SM_ID;
                                //return $adquisicion->SM_ID.''.$stock_new->SM_ID;
                            }

                            /*------------------------------------------STOCK---------------------------------------*/

                            /*------------------------------------------ADQUISICION---------------------------------------*/

                            $adquisicion->BO_ID= $model->BO_ID;
                            $adquisicion->AD_FECHA = date('Y-m-d');
                            $adquisicion->ORC_ID = $orden_compra->ORC_ID;
                            $material = Materiales::findOne($adquisicion->MA_ID);
                            $adquisicion->AD_COSTO_TOTAL= $adquisicion->AD_CANTIDAD * $material->MA_COSTOUNIDAD;
                            $costo_total = $costo_total + $adquisicion->AD_COSTO_TOTAL;
                            /*------------------------------------------ADQUISICION---------------------------------------*/

                            if (! ($flag = $adquisicion->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $orden_compra1 = OrdenCompra::findOne($orden_compra->ORC_ID);
                        $orden_compra1->ORC_COSTO_TOTAL=$costo_total;
                        $orden_compra1->save();
                        $transaction->commit();
                        return $this->redirect(['materiales-pro', 'id' => $proyecto->PRO_ID]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }else{
            return $this->render('multi_adq', [
                'ordenes_trabajos' => $ordenes_trabajos,
                'model' => $model,
                'cant_materiales' => $cant_materiales,
                'proyecto' => $proyecto,
                'orden_compra' => $orden_compra,
                'adquisiciones' => (empty($adquisiciones)) ? [new MatOrcAdquirido] : $adquisiciones
            ]);
        }
    }

    public function actionAutorizarOrdenCompra($id)
    {
        $orden_compra = OrdenCompra::findOne($id);
        $proyecto = Proyecto::findOne($orden_compra->oT->PRO_ID);
        $orden_compra->ORC_ESTADO = 'Autorizado';
        $adquisiciones = MatOrcAdquirido::find()->where(['ORC_ID'=>$id])->all();
        foreach ($adquisiciones as $adquisicion) {
            /*------------------------------------------BODEGA---------------------------------------*/
            if($adquisicion->BO_ID != NULL){
                $almacena_exist = BoMatAlmacena::find()
                    ->where(['OT_ID'=>$adquisicion->sM->OT_ID])
                    ->andWhere(['BO_ID'=>$adquisicion->BO_ID])
                    ->andWhere(['MA_ID'=>$adquisicion->MA_ID])
                    ->one();
                if ($almacena_exist!=NULL) {
                    $almacena_exist->AL_CANTIDAD= $almacena_exist->AL_CANTIDAD + $adquisicion->AD_CANTIDAD;
                    $almacena_exist->save();
                }else{
                    $almacena_new = new BoMatAlmacena();
                    $almacena_new->MA_ID = $adquisicion->MA_ID;
                    $almacena_new->BO_ID = $adquisicion->BO_ID;
                    $almacena_new->AL_CANTIDAD = $adquisicion->AD_CANTIDAD;
                    $almacena_new->OT_ID = $adquisicion->sM->OT_ID;
                    $almacena_new->save();
                }
            /*------------------------------------------BODEGA---------------------------------------*/

            /*------------------------------------------STOCK---------------------------------------*/
            }else{
                $stock= StockMateriales::findOne($adquisicion->SM_ID);
                $stock->SM_CANTIDAD = $stock->SM_CANTIDAD + $adquisicion->AD_CANTIDAD;
                $stock->save();
            }

            /*------------------------------------------STOCK---------------------------------------*/
        }
        $orden_compra->ORC_FECHA_PAGO = date('Y-m-d');
        $orden_compra->save();
        return $this->redirect(['materiales-pro', 'id' => $proyecto->PRO_ID]);
    }

    public function actionAnularOrdenCompra($id)
    {
        $orden_compra = OrdenCompra::findOne($id);
        $proyecto = Proyecto::findOne($orden_compra->oT->PRO_ID);
        $orden_compra->ORC_ESTADO = 'Denegado';
        $orden_compra->save();
        return $this->redirect(['materiales-pro', 'id' => $proyecto->PRO_ID]);
    }

    public function actionIndexOc($id)
    {
        $proyecto = Proyecto::findOne($id);
        $array_ot = OrdenTrabajo::find()->select('OT_ID')->where(['PRO_ID'=>$id])->asArray()->all();
        $array_stock = StockMateriales::find()->select('SM_ID')->where(['OT_ID'=>$array_ot])->asArray()->all();
        $array_compras = MatOrcAdquirido::find()->select('ORC_ID')->where(['SM_ID'=>$array_stock])->asArray()->all();

        $ordenes_compra = OrdenCompra::find()->where(['ORC_ID'=>$array_compras])->all();
        $envio=null;
        foreach ($ordenes_compra as $count => $compra) {
            $bodega = MatOrcAdquirido::find()->where(['ORC_ID'=>$compra->ORC_ID])->one();
            if ($bodega->BO_ID != NULL) {
                $envio[] = $bodega->bO->BO_NOMBRE;
            }else{
                $envio[] = 'Obra';
            }
        }


        return $this->renderAjax('index_orden_c', [
            'proyecto'=>$proyecto,
            'ordenes_compra'=>$ordenes_compra,
            'envio'=>$envio,
        ]);
    }

    public function actionVerOrdenCompra($id)
    {
        $orden_compra = OrdenCompra::findOne($id);
        $compras = MatOrcAdquirido::find()->where(['ORC_ID'=>$id])->all();
        $bodega = MatOrcAdquirido::find()->where(['ORC_ID'=>$orden_compra->ORC_ID])->one();
        if($bodega->BO_ID!=NULL){
            $envio=$bodega->bO->BO_NOMBRE;
        }else{
            $envio = 'Obra';
        }
        return $this->renderAjax('view_compra', [
            'orden_compra'=>$orden_compra,
            'compras'=>$compras,
            'envio'=>$envio,
        ]);
    }

/*########################################################################################################################*/
/*###################################################### ORDEN-COMPRA ######################################################*/
/*########################################################################################################################*/


/*########################################################################################################################*/
/*###################################################### ORDEN-DESPACHO ######################################################*/
/*########################################################################################################################*/

    public function actionOrdenDespachoIndex()
    {
        $array_ot = OrdenTrabajo::find()->select('OT_ID')->asArray()->all();
        $ordenes_despacho = OrdenDespacho::find()->where(['OT_ID'=>$array_ot])->all();

        return $this->render('index_ordendespacho', [
            'ordenes_despacho'=>$ordenes_despacho,
        ]);
    }

    public function actionIngresarOrdenDespacho($id)
    {
        $orden_despacho= new OrdenDespacho();
        $despachos=[new OdMatEspecifica];
        $ordenes_trabajos = OrdenTrabajo::find()->where(['not in','OT_ESTADO', 'Finalizado'])->all();

        $model = new BoMatAlmacena();

        $array_ot = OrdenTrabajo::find()->select('OT_ID')->where(['PRO_ID'=>$id])->asArray()->all();
        $array_alm = BoMatAlmacena::find()->select('AL_ID')->where(['OT_ID'=>$array_ot])->asArray()->all();
        $array_despachos= OdMatEspecifica::find()->select('OD_ID')->where(['AL_ID'=>$array_alm])->asArray()->all();


        $cant_almacenados= BoMatAlmacena::find()->where(['OT_ID'=>$array_ot])->count();
        $materiales= BoMatAlmacena::find()->where(['OT_ID'=>$array_ot])->all();


        $cantidad_od= OrdenDespacho::find()->where(['OD_ID'=>$array_alm])->count();

        $orden_despacho->OD_FECHA_EMISION= date('Y-m-d');
        $orden_despacho->OD_NUMERO_ORDEN = $cantidad_od+1;
        $orden_despacho->OD_ESTADO = 'Pendiente';

        $almacenados= new BoMatAlmacena();

        if ($orden_despacho->load(Yii::$app->request->post())) {
            $despachos = Model::createMultiple(OdMatEspecifica::classname());
            Model::loadMultiple($despachos, Yii::$app->request->post());


            $orden_despacho->save();
            $valid = $orden_despacho->validate();
            $valid = Model::validateMultiple($despachos) && $valid;
            $valid=true;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $orden_despacho->save(false)) {
                        foreach ($despachos as $despacho) {


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
                        return $this->redirect(['materiales-pro', 'id' => $proyecto->PRO_ID]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }

            }


        }else{
            return $this->render('_form_despacho', [
                'ordenes_trabajos' => $ordenes_trabajos,
                'orden_despacho' => $orden_despacho,
                'almacenados' => $almacenados,
                'materiales' => $materiales,
                'cant_almacenados' => $cant_almacenados,
                'despachos' => (empty($despachos)) ? [new OdMatEspecifica] : $despachos
            ]);
        }
    }





    public function actionCrearOrdenDespacho($id)
    {
        $orden_despacho= new OrdenDespacho();
        $despachos=[new OdMatEspecifica];
        $ordenes_trabajos = OrdenTrabajo::find()->where(['not in','OT_ESTADO', 'Finalizado'])->all();

        $model = new BoMatAlmacena();

        $array_ot = OrdenTrabajo::find()->select('OT_ID')->where(['PRO_ID'=>$id])->asArray()->all();
        $array_alm = BoMatAlmacena::find()->select('AL_ID')->where(['OT_ID'=>$array_ot])->asArray()->all();
        $array_despachos= OdMatEspecifica::find()->select('OD_ID')->where(['AL_ID'=>$array_alm])->asArray()->all();


        $cant_almacenados= BoMatAlmacena::find()->where(['OT_ID'=>$array_ot])->count();
        $materiales= BoMatAlmacena::find()->where(['OT_ID'=>$array_ot])->all();


        $cantidad_od= OrdenDespacho::find()->where(['OD_ID'=>$array_alm])->count();

        $orden_despacho->OD_FECHA_EMISION= date('Y-m-d');
        $orden_despacho->OD_NUMERO_ORDEN = $cantidad_od+1;
        $orden_despacho->OD_ESTADO = 'Pendiente';

        $almacenados= new BoMatAlmacena();

        if ($orden_despacho->load(Yii::$app->request->post())) {
            $despachos = Model::createMultiple(OdMatEspecifica::classname());
            Model::loadMultiple($despachos, Yii::$app->request->post());


            $orden_despacho->save();
            $valid = $orden_despacho->validate();
            $valid = Model::validateMultiple($despachos) && $valid;
            $valid=true;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $orden_despacho->save(false)) {
                        foreach ($despachos as $despacho) {


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
                        return $this->redirect(['materiales-pro', 'id' => $proyecto->PRO_ID]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }

            }


        }else{
            return $this->render('_form_despacho', [
                'ordenes_trabajos' => $ordenes_trabajos,
                'orden_despacho' => $orden_despacho,
                'almacenados' => $almacenados,
                'materiales' => $materiales,
                'cant_almacenados' => $cant_almacenados,
                'despachos' => (empty($despachos)) ? [new OdMatEspecifica] : $despachos
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


        $cant_almacenados= BoMatAlmacena::find()->where(['OT_ID'=>$array_ot])->count();
        $materiales= BoMatAlmacena::find()->where(['OT_ID'=>$array_ot])->all();


        $cantidad_od= OrdenDespacho::find()->where(['OD_ID'=>$array_alm])->count();

        $orden_despacho->OD_FECHA_EMISION= date('Y-m-d');
        $orden_despacho->OD_NUMERO_ORDEN = $cantidad_od+1;
        $orden_despacho->OD_ESTADO = 'Pendiente';

        $almacenados= new BoMatAlmacena();

        if ($orden_despacho->load(Yii::$app->request->post())) {
            $despachos = Model::createMultiple(OdMatEspecifica::classname());
            Model::loadMultiple($despachos, Yii::$app->request->post());


            $orden_despacho->save();
            $valid = $orden_despacho->validate();
            $valid = Model::validateMultiple($despachos) && $valid;
            $valid=true;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $orden_despacho->save(false)) {
                        foreach ($despachos as $despacho) {


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
                        return $this->redirect(['materiales-pro', 'id' => $proyecto->PRO_ID]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }

            }


        }else{
            return $this->render('_form_despacho', [
                'ordenes_trabajos' => $ordenes_trabajos,
                'orden_despacho' => $orden_despacho,
                'almacenados' => $almacenados,
                'materiales' => $materiales,
                'cant_almacenados' => $cant_almacenados,
                'proyecto' => $proyecto,
                'despachos' => (empty($despachos)) ? [new OdMatEspecifica] : $despachos
            ]);
        }
    }

    public function actionAutorizarOrdenDespacho($id)
    {
        $orden_despacho = OrdenDespacho::findOne($id);
        $proyecto = Proyecto::findOne($orden_despacho->oT->PRO_ID);

        if ($orden_despacho->OD_ESTADO == 'Pendiente') {
            $orden_despacho->OD_ESTADO = 'Autorizado';
            $despacho_alm = OdMatEspecifica::find()->where(['OD_ID'=>$id])->all();
            foreach ($despacho_alm as $despacho) {
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
            }
            $orden_despacho->OD_FECHA_RECEPCION= date('Y-m-d');
            $orden_despacho->save();
        }
        return $this->redirect(['materiales-pro', 'id' => $proyecto->PRO_ID]);
    }

    public function actionDenegarOrdenDespacho($id)
    {
        $orden_despacho = OrdenDespacho::findOne($id);
        $proyecto = Proyecto::findOne($orden_despacho->oT->PRO_ID);

        if ($orden_despacho->OD_ESTADO == 'Pendiente') {
            $orden_despacho->OD_ESTADO = 'Denegado';
            $orden_despacho->save();
        }
        return $this->redirect(['materiales-pro', 'id' => $proyecto->PRO_ID]);
    }

    public function actionIndexOd($id)
    {
        $proyecto = Proyecto::findOne($id);
        $array_ot = OrdenTrabajo::find()->select('OT_ID')->where(['PRO_ID'=>$id])->asArray()->all();
        $ordenes_despacho = OrdenDespacho::find()->where(['OT_ID'=>$array_ot])->all();

        return $this->renderAjax('index_orden_d', [
            'proyecto'=>$proyecto,
            'ordenes_despacho'=>$ordenes_despacho,
        ]);
    }

    public function actionVerOrdenDespacho($id)
    {
        $orden_despacho = OrdenDespacho::findOne($id);
        $despachos = OdMatEspecifica::find()->where(['OD_ID'=>$id])->all();
        return $this->renderAjax('view_despacho', [
            'orden_despacho'=>$orden_despacho,
            'despachos'=>$despachos,
        ]);
    }

/*########################################################################################################################*/
/*###################################################### ORDEN-DESPACHO ######################################################*/
/*########################################################################################################################*/



    public function actionListaMateriales($id)
    {
        $almacenados = BoMatAlmacena::find()->where(['OT_ID'=>$id])->all();
        if ($almacenados!=NULL) {
            $array_mat=[];
            foreach ($almacenados as $alm) {
                $array_mat[]="<option value='".$almacenados->MA_ID."'>".$almacenados->mA->MA_NOMBRE."</option>";
            }
            echo $array_mat;
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

    public function actionGetCosto($id){
        $almacenado= BoMatAlmacena::findOne($id);
        $bodega = Bodegas::findOne($almacenado->BO_ID);
        $datos = [
            'bodega'=>$almacenado->bO->BO_NOMBRE,
            'id_material'=>$almacenado->MA_ID,
            'costo'=>$almacenado->mA->MA_COSTOUNIDAD,
            'unidad'=>$almacenado->mA->MA_UNIDAD,
            'cantidad'=>$almacenado->AL_CANTIDAD
        ];
        echo Json::encode($datos);
    }

    public function actionGetPro($id)
    {
        $orden_trabajo = OrdenTrabajo::findOne($id);
        $array_ot = OrdenTrabajo::find()->select('OT_ID')->where(['PRO_ID'=>$orden_trabajo->PRO_ID])->asArray()->all();
        $array_stock = StockMateriales::find()->select('SM_ID')->where(['OT_ID'=>$array_ot])->asArray()->all();
        $array_adq = MatOrcAdquirido::find()->select('ORC_ID')->where(['SM_ID'=>$array_stock])->asArray()->all();
        $numero_orc = OrdenCompra::find()->where(['ORC_ID'=>$array_adq])->count();

        $datos = [
            'nombre'=>$orden_trabajo->pRO->PRO_NOMBRE,
            'ciudad'=>$orden_trabajo->pRO->cOM->COM_NOMBRE,
            'direccion'=>$orden_trabajo->pRO->PRO_DIRECCIOM,
            'numero_orden'=>($numero_orc + 1),
        ];
        echo Json::encode($datos);
    }

    public function actionGetMatDespacho($id)
    {
        $OrdenTrabajo = OrdenTrabajo::findOne($id);
    }

    public function actionGetOt($id){

        $ordentrabajo = OrdenTrabajo::findOne($id);
        $cant_oc = OrdenCompra::find()->where(['OT_ID'=>$id])->count();
        $datos = [
            'numero_orden'=>($cant_oc + 1),
            'proyecto'=>$ordentrabajo->pRO->PRO_NOMBRE,
            'direccion'=>$ordentrabajo->pRO->PRO_DIRECCION,
            'ciudad'=>$ordentrabajo->pRO->cOM->COM_NOMBRE,
        ];
        echo Json::encode($datos);
    }
}
