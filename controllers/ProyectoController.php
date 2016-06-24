<?php

namespace app\controllers;

use Yii;
use app\models\Proyecto;
use app\models\Persona;
use app\models\Usuario;
use app\models\UsuariosControla;
use app\models\EmpresaCliente;
use app\models\ProyectoSearch;
use app\models\OrdenTrabajo;
use app\models\Actividades;
use app\models\ActSactAsigna;
use app\models\StockMateriales;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use kartik\mpdf\Pdf;

/**
 * ProyectoController implements the CRUD actions for Proyecto model.
 */
class ProyectoController extends Controller
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
     * Lists all Proyecto models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = Proyecto::find()->all();
        $searchModel = new ProyectoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
        ]);
    }

    /**
     * Displays a single Proyecto model.
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
     * Creates a new Proyecto model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Proyecto();
        $cliente = new EmpresaCliente();
        if ($model->load(Yii::$app->request->post()) && $cliente->load(Yii::$app->request->post())) {
            $model->PRO_ESTADO='Pendiente';
            $cliente->save();
            $model->EMP_RUT=$cliente->EMP_RUT;
            $model->save();
            return $this->redirect(['view', 'id' => $model->PRO_ID]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'cliente' => $cliente,
            ]);
        }
    }

    /**
     * Updates an existing Proyecto model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->PRO_ID]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Proyecto model.
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
     * Finds the Proyecto model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Proyecto the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Proyecto::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    public function actionAsignarEncargado($id){
        $proyectos= Proyecto::find()->select('PRO_ID')->where(['not in','PRO_ESTADO','Finalizado'])->asArray()->all();
        //if($proyectos!=NULL){
            if($proyectos!=NULL){
            $controla= UsuariosControla::find()->select('US_ID')->where(['PRO_ID'=>$proyectos])->asArray()->all();
                $usuario= Usuario::find()->select('PE_RUT')->where(['US_ID'=>$controla])->asArray()->all();
                $encargados= Persona::find()->where(['CA_ID'=>3])->andWhere(['not in','PE_RUT',$usuario])->all();

            }else{
                $encargados= Persona::find()->where(['CA_ID'=>3])->all();

            }
            $asigna= new UsuariosControla();
            $encargado= new Persona();
            $asigna->PRO_ID=$id;
        //}else{
        //    $encargados= Persona::find()->where(['CA_ID'=>3])->all();
        //}

        if ($encargado->load(Yii::$app->request->post())) {
            $usuario=Usuario::find()->where(['PE_RUT'=>$encargado->PE_RUT])->one();
            $asigna->US_ID=$usuario->US_ID;
            $asigna->save();
            return $this->redirect(['view', 'id' => $id]);
        } else {
            return $this->renderAjax('asigna', [
                'encargado' => $encargado,
                'encargados' => $encargados,
            ]);
        }
    }
    public function actionInformesPro($id)
    {
        $proyecto= Proyecto::findOne($id);
        $orden_trabajos= OrdenTrabajo::find()->where(['PRO_ID'=>$id])->all();
            return $this->render('informes_pro', [
                'proyecto' => $proyecto,
                'orden_trabajos' => $orden_trabajos,
            ]);

    }

    public function actionInformeOt($idot/*, $inicio, $fin*/)
    {
        $model = OrdenTrabajo::findOne($idot);
        $proyecto = $this->findModel($model->PRO_ID);
        $actividades = Actividades::find()->where(['OT_ID'=>$model->OT_ID])->all();
        $array_act = Actividades::find()->select('AC_ID')->where(['OT_ID'=>$model->OT_ID])->asArray()->all();

        $items = ActSactAsigna::find()->where(['AC_ID'=>$array_act])->all();


        $stock = StockMateriales::find()->where(['OT_ID'=>$idot])->all();
        $array_stock= StockMateriales::find()->select('SM_ID')->where(['OT_ID'=>$idot])->asArray()->all();
        //$transacciones= TransaccionMateriales::find()->where(['SM_ID'=>$array_stock])->andWhere('TM_FECHACOMPRA > :x and TM_FECHACOMPRA < :y',[':x'=>$inicio, ':y'=>$fin])->all();

        $content= $this->renderPartial('informe', [
                                            'model' => $model,
                                            'actividades' => $actividades,
                                            'items' => $items,
                                            //'transacciones' => $transacciones,
                                        ]);
        $pdf = new Pdf();
        $mpdf = $pdf->api; // fetches mpdf api
        $mpdf->SetHeader('MyM construcción y electricidad'); // call methods or set any properties
        $mpdf->WriteHtml($content); // call mpdf write html
        $mpdf->cssFile='@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css';
        $mpdf->Output(); // call the mpdf api output as needed
        exit;
    }

}
