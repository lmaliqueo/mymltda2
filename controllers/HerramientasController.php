<?php

namespace app\controllers;

use Yii;
use app\models\Herramientas;
use app\models\HerramientasSearch;
use app\models\EstadoHerramientas;
use app\models\DhHeRetiran;
use app\models\RhHeReingresan;
use app\models\DespachoHerramientas;
use app\models\RetornoHerramientas;
use app\models\OrdenTrabajo;
use app\models\Bodegas;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use app\models\Model;

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
        $model = $this->findModel($id);
        return $this->renderAjax('view', [
            'model' => $model,
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

        if ($model->load(Yii::$app->request->post())) {
            $model->HE_ESTADO='Libre';
            $model->save();
            \Yii::$app->getSession()->setFlash('success', 'La herramienta se guardo exitosamente');
            return $this->redirect(['index']);
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
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->HE_ID]);
        } else {
            return $this->renderAjax('update', [
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

    public function actionDespachosIndex()
    {
        $despachos_he= DespachoHerramientas::find()->all();

        return $this->render('index_despacho', [
            'despachos_he' => $despachos_he,
        ]);
    }

    public function actionRetornoIndex()
    {
        $retorno_he = RetornoHerramientas::find()->all();
        return $this->render('index_retorno', [
            'retorno_he' => $retorno_he,
        ]);
    }


    public function actionCrearDespachos()
    {
        $herramientas = Herramientas::find()->where(['HE_ESTADO'=>'Libre'])->all();
        $cant_herramientas = Herramientas::find()->where(['HE_ESTADO'=>'Libre'])->count();
        $despacho_he = new DespachoHerramientas();
        $ordenes_trabajos= OrdenTrabajo::find()->where(['not in', 'OT_ESTADO', 'Finalizado'])->all();


        $salidas_herramientas= [new DhHeRetiran];

        if ($despacho_he->load(Yii::$app->request->post())) {
            $salidas_herramientas = Model::createMultiple(DhHeRetiran::classname());
            Model::loadMultiple($salidas_herramientas, Yii::$app->request->post());

            $valid = Model::validateMultiple($salidas_herramientas);
            $valid = true;

            $despacho_he->DH_ESTADO='Enviados';
            $despacho_he->DH_FECHA_SALIDA = date('Y-m-d');

            if ($valid) {
                //$model->save();
                $transaction = \Yii::$app->db->beginTransaction();
                $despacho_he->save();
                try {
                    if ($flag = $despacho_he->save(false)) {

                        foreach ($salidas_herramientas as $salida_he) {

                            $salida_he->DH_ID = $despacho_he->DH_ID;
                            $herramienta = Herramientas::findOne($salida_he->HE_ID);
                            $herramienta->HE_ESTADO = 'Utilizando';
                            $herramienta->save();

                            if (! ($flag = $salida_he->save(false))) {
                                $transaction->rollBack();
                                break;
                            }

                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        \Yii::$app->getSession()->setFlash('success', 'El despacho de herramientas se guardo exitosamente');
                        return $this->redirect(['despachos-index']);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }else{
            return $this->render('_form_despacho_he', [
                'cant_herramientas' => $cant_herramientas,
                'ordenes_trabajos' => $ordenes_trabajos,
                'despacho_he' => $despacho_he,
                'herramientas' => $herramientas,
                'salidas_herramientas' => (empty($salidas_herramientas)) ? [new DhHeRetiran] : $salidas_herramientas
            ]);
        }

    }

    public function actionCrearDevolucion()
    {
        $herramientas = Herramientas::find()->where(['HE_ESTADO'=>'Ocupados'])->all();
        $cant_herramientas = Herramientas::find()->where(['HE_ESTADO'=>'Utilizando'])->count();
        $retorno_he = new RetornoHerramientas();
        $ordenes_trabajos= OrdenTrabajo::find()->where(['not in', 'OT_ESTADO', 'Finalizado'])->all();


        $salidas_herramientas= [new RhHeReingresan];

        if ($retorno_he->load(Yii::$app->request->post())) {
            $salidas_herramientas = Model::createMultiple(RhHeReingresan::classname());
            Model::loadMultiple($salidas_herramientas, Yii::$app->request->post());

            $valid = Model::validateMultiple($salidas_herramientas);
            $valid = true;

            $retorno_he->RH_FECHA_RETORNO = date('Y-m-d');
            $retorno_he->RH_ESTADO = 'Devueltos';

            if ($valid) {
                //$model->save();
                $transaction = \Yii::$app->db->beginTransaction();
                $retorno_he->save();
                try {
                    if ($flag = $retorno_he->save(false)) {

                        foreach ($salidas_herramientas as $salida_he) {

                            $salida_he->RH_ID = $retorno_he->RH_ID;
                            $herramienta = Herramientas::findOne($salida_he->HE_ID);
                            $herramienta->HE_ESTADO = 'Libre';
                            $herramienta->save();
                            
                            if (! ($flag = $salida_he->save(false))) {
                                $transaction->rollBack();
                                break;
                            }

                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        \Yii::$app->getSession()->setFlash('success', 'Las devoluciones de herramienta se ingreso exitosamente');
                        return $this->redirect(['retorno-index']);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }else{
            return $this->render('_form_devolucion_he', [
                'cant_herramientas' => $cant_herramientas,
                'retorno_he' => $retorno_he,
                'ordenes_trabajos' => $ordenes_trabajos,
                'herramientas' => $herramientas,
                'salidas_herramientas' => (empty($salidas_herramientas)) ? [new RhHeReingresan] : $salidas_herramientas
            ]);
        }

    }



    public function actionGetHerramienta($id)
    {
        $herramienta = Herramientas::findOne($id);
        $datos = [
                'descripcion'=>$herramienta->HE_DESCRIPCION,
                'tipo_herramienta'=>$herramienta->tH->TH_NOMBRE,
                'bodega'=>$herramienta->bO->BO_NOMBRE,
                'costo_asociado'=>$herramienta->HE_COSTOUNIDAD,
                'estado'=>$herramienta->HE_ESTADO,
            ];
        echo Json::encode($datos);
    }

}
