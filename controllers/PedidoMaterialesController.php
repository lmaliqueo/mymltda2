<?php

namespace app\controllers;

use Yii;
use app\models\PedidoMateriales;
use app\models\PedidoMaterialesSearch;
use app\models\PedidoAdjunta;
use app\models\StockMateriales;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Model;

/**
 * PedidoMaterialesController implements the CRUD actions for PedidoMateriales model.
 */
class PedidoMaterialesController extends Controller
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
     * Lists all PedidoMateriales models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PedidoMaterialesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PedidoMateriales model.
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
     * Creates a new PedidoMateriales model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreateMulti()
    {
        $model = new PedidoMateriales();
        $stock= new StockMateriales();
        $padjunta= [new PedidoAdjunta];

        if ($model->load(Yii::$app->request->post())) {
            $model->PM_FECHA= date('Y-m-d');
            $model->PM_ESTADO= 'Pendiente';


            $padjunta = Model::createMultiple(PedidoAdjunta::classname());
            Model::loadMultiple($padjunta, Yii::$app->request->post());
           // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($padjunta) && $valid;

            if ($valid) {
                $model->save();
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        foreach ($padjunta as $padjunta) {

                            $padjunta->PM_ID = $model->PM_ID;

                            if (! ($flag = $padjunta->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['orden-trabajo/transaccion', 'id' => $model->sM->OT_ID]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }






        } else {
            return $this->render('createmulti', [
                'model' => $model,
                'padjunta' => (empty($padjunta)) ? [new PedidoAdjunta] : $padjunta,
                'stock' => $stock,
           ]);
        }
    }


    public function actionCreate($idot, $idmat)
    {
        $model = new PedidoMateriales();
        $adjunta= new PedidoAdjunta();
        $stock= StockMateriales::find()->where('OT_ID=:x'&&'MA_ID=:y', [':x'=>$idot, ':y'])->one();
        $adjunta->SM_ID=$stock->SM_ID;

        if ($model->load(Yii::$app->request->post()) && $adjunta->load(Yii::$app->request->post()) && $stock->load(Yii::$app->request->post())) {
            $model->PM_FECHA= date('Y-m-d');
            $model->PM_ESTADO= 'Pendiente';
            $model->save();
            $adjunta->PM_ID=$model->PM_ID;
            $adjunta->save();
            return $this->redirect(['orden-trabajo/transaccion', 'id' => $model->sM->OT_ID]);

        } else {
            return $this->renderAjax('create', [
                'model' => $model,
                'adjunta' => $adjunta,
           ]);
        }
    }

    /**
     * Updates an existing PedidoMateriales model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->PM_ID]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing PedidoMateriales model.
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
     * Finds the PedidoMateriales model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PedidoMateriales the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PedidoMateriales::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
