<?php

namespace app\controllers;

use Yii;
use app\models\ReportesAvances;
use app\models\ReportesAvancesSearch;
use app\models\Proyecto;
use app\models\OrdenTrabajo;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;

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
        $proyecto = Proyecto::findOne($id);
        $array_ot= OrdenTrabajo::find()->select('OT_ID')->where(['PRO_ID'=>$id])->asArray()->all();
        $searchModel = new ReportesAvancesSearch();
        $reportes= ReportesAvances::find()->where(['OT_ID'=>$array_ot])->all();
        $dataProvider = new ActiveDataProvider([
            'query' => ReportesAvances::find()->
                where(['OT_ID'=>$array_ot]),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'reportes' => $reportes,
            'proyecto' => $proyecto,
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

        if ($model->load(Yii::$app->request->post())) {
            $model->save();
            return $this->redirect(['view', 'id' => $model->RA_ID]);
        } else {
            return $this->renderAjax('_form', [
                'model' => $model,
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
}
