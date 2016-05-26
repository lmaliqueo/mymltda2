<?php

namespace app\controllers;

use Yii;
use kartik\mpdf\Pdf;
use app\models\OrdenTrabajo;
use app\models\OrdenTrabajoSearch;
use app\models\StockMateriales;
use app\models\TransaccionMateriales;
use app\models\Proyecto;
use app\models\PedidoAdjunta;
use app\models\Actividades;
use app\models\ActividadesSearch;
use app\models\MatProvAdquirido;
use app\models\Materiales;
use app\models\ActSactAsigna;
use app\models\CantidadUtilizada;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

/**
 * OrdenTrabajoController implements the CRUD actions for OrdenTrabajo model.
 */
class OrdenTrabajoController extends Controller
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
     * Lists all OrdenTrabajo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OrdenTrabajoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single OrdenTrabajo model.
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
     * Creates a new OrdenTrabajo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($pro)
    {
        $model = new OrdenTrabajo();
        $model->PRO_ID = $pro;
        if ($model->load(Yii::$app->request->post())) {
            $model->OT_ESTADO='Pendiente';
            $model->save();
            return $this->redirect(['view', 'id' => $model->OT_ID]);
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing OrdenTrabajo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->OT_ID]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing OrdenTrabajo model.
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
     * Finds the OrdenTrabajo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return OrdenTrabajo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = OrdenTrabajo::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


        public function actionIndexpro($id)
    {
        $searchModel = new OrdenTrabajoSearch();
        $searchModel->PRO_ID = $id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $proyecto = Proyecto::findOne($id);
        $model = OrdenTrabajo::find()->where(['PRO_ID'=>$id, 'OT_ESTADO'=>'Activo'])->orderBy(['OT_FECHA_INICIO' => SORT_DESC,])->one();
        $ordenes = OrdenTrabajo::find()->where(['PRO_ID'=>$id])->orderBy(['OT_FECHA_INICIO' => SORT_ASC,])->all();
        foreach ($ordenes as $ot) {
            $activo=Actividades::find()->where(['OT_ID'=>$ot->OT_ID])->one();
            if ($activo!=NULL) {
                $ot->OT_ESTADO='Activo';
                $ot->save();
            }
        }
        if($model!=NULL){
            $actividades= Actividades::find()->where(['OT_ID'=>$model->OT_ID])->all();
        }else{
            $actividades= NULL;
        }
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'proyecto' => $proyecto,
            'model' => $model,
            'ordenes' => $ordenes,
            'actividades' => $actividades,
        ]);
    }

        public function actionTransaccion($id)
    {
        $stock= StockMateriales::find()->where('OT_ID=:x',[':x'=>$id])->all();

        $idstock= StockMateriales::find()->where(['OT_ID' => $id])->asArray()->all();

        $adjunta= PedidoAdjunta::find()->where(['SM_ID'=>$idstock])->all();
        $transaccion= TransaccionMateriales::find()->where(['SM_ID'=>$idstock])->asArray()->all();
        $adquirido= MatProvAdquirido::find()->where(['TM_ID'=>$transaccion])->all();
        return $this->renderAjax('transaccion', [
            'stock' => $stock,
            'adquirido' => $adquirido,
            'adjunta' => $adjunta,
            'model' => $this->findModel($id),
        ]);
    }
    public function actionGetMovimientos($idstock, $idmat){
        $stock= StockMateriales::findOne($idstock);
        $transaccion= TransaccionMateriales::find()->where(['SM_ID'=>$idstock])->asArray()->all();
        $adquirido= MatProvAdquirido::find()->where(['TM_ID'=>$transaccion])->all();

        $utilizados= CantidadUtilizada::find()->where(['SM_ID'=>$idstock])->orderBy(['CU_FECHA_FINAL'=>SORT_ASC,])->all();

            return $this->renderAjax('transaccionmat', [
                'adquirido' => $adquirido,
                'stock'=> $stock,
                'utilizados'=> $utilizados,
            ]);
    }

    public function actionGetPedidos($mat, $ot){
        $material= Materiales::find()->where(['MA_NOMBRE'=>$mat])->one();
        $orden= OrdenTrabajo::find()->where(['OT_NOMBRE'=>$ot])->one();
        $stock= StockMateriales::find()->where(['MA_ID'=>$material->MA_ID, 'OT_ID'=>$orden->OT_ID])->one();
        $pedidos= PedidoAdjunta::find()->where(['SM_ID'=>$stock->SM_ID])->all();
            return $this->renderAjax('pedidos', [
                'pedidos' => $pedidos,
                'material'=> $material,
            ]);
    }

    public function actionIndexAct($id)
    {
        $ordentrabajo= OrdenTrabajo::findOne($id);
        $searchModel = new ActividadesSearch();
        $searchModel->OT_ID=$id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->renderAjax('indexact', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'ordentrabajo' => $ordentrabajo,
        ]);
    }

    public function actionInformeMat($idot/*, $inicio, $fin*/)
    {
        $model = OrdenTrabajo::findOne($idot);
        $stock = StockMateriales::find()->where(['OT_ID'=>$idot])->all();
        $array_stock= StockMateriales::find()->select('SM_ID')->where(['OT_ID'=>$idot])->asArray()->all();
        //$transacciones= TransaccionMateriales::find()->where(['SM_ID'=>$array_stock])->andWhere('TM_FECHACOMPRA > :x and TM_FECHACOMPRA < :y',[':x'=>$inicio, ':y'=>$fin])->all();

        $content= $this->renderPartial('informe_trans', [
                                            'model' => $model,
                                            'stock' => $stock,
                                            //'transacciones' => $transacciones,
                                        ]);
        $pdf = new Pdf();
        $mpdf = $pdf->api; // fetches mpdf api
        $mpdf->SetHeader('Kartik Header'); // call methods or set any properties
        $mpdf->WriteHtml($content); // call mpdf write html
        $mpdf->cssFile='@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css';
        $mpdf->Output(); // call the mpdf api output as needed
        exit;
    }
    public function actionButtonAct($id){
        $model=OrdenTrabajo::findOne($id);
        return $this->renderAjax('button_act', [
            'model' => $model,
        ]);
    }
    public function actionInfoGeneral($id)
    {
        $model= OrdenTrabajo::findOne($id);
        $actividades= Actividades::find()->where(['OT_ID'=>$id])->all();
        $array_act= Actividades::find()->select('AC_ID')->where(['OT_ID'=>$id])->asArray()->all();

        $subactividades= ActSactAsigna::find()->where(['AC_ID'=>$array_act])->all();


        return $this->renderAjax('general', [
            'model' => $model,
            'actividades' => $actividades,
            'subactividades' => $subactividades,
        ]);
       

    }
}
