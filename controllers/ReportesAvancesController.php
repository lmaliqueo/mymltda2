<?php

namespace app\controllers;

use Yii;
use app\models\ReportesAvances;
use app\models\ReportesAvancesSearch;
use app\models\Proyecto;
use app\models\OrdenTrabajo;
use app\models\Actividades;
use app\models\ActSactAsigna;
use app\models\AsignaAcumula;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\data\Exception;
use yii\base\Model;

/**
 * ReportesAvancesController implements the CRUD actions for ReportesAvances model.
 */
class ReportesAvancesController extends Controller
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
     * Lists all ReportesAvances models.
     * @return mixed
     */
    public function actionIndex($id)
    {
        $ordentrabajo = OrdenTrabajo::findOne($id);
        $searchModel = new ReportesAvancesSearch();
        $reportes= ReportesAvances::find()->where(['OT_ID'=>$ordentrabajo->OT_ID])->all();
        $dataProvider = new ActiveDataProvider([
            'query' => ReportesAvances::find()->
                where(['OT_ID'=>$ordentrabajo->OT_ID]),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'ordentrabajo' => $ordentrabajo,
        ]);
    }

    /**
     * Displays a single ReportesAvances model.
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
     * Creates a new ReportesAvances model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        $model = new ReportesAvances();
        $model->RA_FECHA=date('Y-m-d');
        $model->OT_ID=$id;


        $array_act = Actividades::find()->select('AC_ID')->where(['OT_ID'=>$id])->andWhere(['AC_ESTADO' => 'En proceso'])->asArray()->all();
        $subact = ActSactAsigna::find()->where(['AC_ID'=>$array_act])->all();

        $arreglo = [new AsignaAcumula];

        foreach ($subact as $asi) {
            $acumula = new AsignaAcumula();
            $acumula->AS_ID = $asi->AS_ID;
            $acumula->AA_CANTIDAD = 0;
            $arreglo[]=$acumula;
        }

        if (Model::loadMultiple($arreglo, Yii::$app->request->post()) && $model->load(Yii::$app->request->post()) ) {

                $transaction = Yii::$app->db->beginTransaction();


                try {
                    $model->save();
                    foreach ($arreglo as $acumulado) {
                        $acumulado->RA_ID = $model->RA_ID;
                        if ($acumulado->AA_CANTIDAD != 0) {
                            $item = ActSactAsigna::findOne($acumulado->AS_ID);
                            $item->AS_CANTIDADACTUAL = $item->AS_CANTIDADACTUAL + $acumulado->AA_CANTIDAD;
                            $item->save();
                        }
                        $acumulado->save();
                        //if (! ($flag = $acumulado->save())) {
                        //    $transaction->rollBack();
                        //    break;
                        //}
                    }
                    $transaction->commit();
                    \Yii::app()->getSession()->setFlash('success', "El reporte de avances se ingreso correctamente");
                    return $this->actionIndex($id);
                } catch (Exception $e) {
                    $transaction->rollBack();
                    \Yii::app()->getSession()->setFlash('error', "No se logró guardar el reporte ingresado");
                    $this->refresh();
                }
            
//            return $this->redirect(['view', 'id' => $model->EP_ID]);
        } else {
            return $this->render('_form', [
                'model' => $model,
                'arreglo' => $arreglo,
                'subact' => $subact,
            ]);
        }




    }

    /**
     * Updates an existing ReportesAvances model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->RA_ID]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ReportesAvances model.
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
     * Finds the ReportesAvances model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ReportesAvances the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ReportesAvances::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionViewModal($id)
    {
        return $this->renderAjax('view', [
            'model' => $this->findModel($id),
        ]);
    }
}
