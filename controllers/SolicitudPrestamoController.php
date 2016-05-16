<?php

namespace app\controllers;

use Yii;
use app\models\SolicitudPrestamo;
use app\models\SolicitudPrestamoSearch;
use app\models\SpreHeSolicita;
use app\models\HerramientaTiene;
use app\models\EstadoHerramientas;
use app\models\Model;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SolicitudPrestamoController implements the CRUD actions for SolicitudPrestamo model.
 */
class SolicitudPrestamoController extends Controller
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
     * Lists all SolicitudPrestamo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SolicitudPrestamoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SolicitudPrestamo model.
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
     * Creates a new SolicitudPrestamo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SolicitudPrestamo();
        $prestamo= [new SpreHeSolicita];
            $model->SPRE_FECHA= date('Y-m-d');
            $model->SPRE_ESTADO='Pendiente';
            $libre= EstadoHerramientas::find()->where('EH_NOMBREESTADO=:x',[':x'=>'Libre'])->one();
            $prestados= EstadoHerramientas::find()->where('EH_NOMBREESTADO=:x',[':x'=>'Prestados'])->one();
        if ($model->load(Yii::$app->request->post())) {
            //$model->save();
            $prestamo = Model::createMultiple(SpreHeSolicita::classname());
            Model::loadMultiple($prestamo, Yii::$app->request->post());



            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($prestamo) && $valid;

            if ($valid) {
                $model->save();
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        foreach ($prestamo as $prestamo) {
                            $prestamo->SPRE_ID = $model->SPRE_ID;
                            /*$tiene= HerramientaTiene::find()->where('HE_ID=:x AND EH_ID=:y',[':x'=>$prestamo->HE_ID, ':y'=>$prestados->EH_ID])->one();

                            if($tiene==NULL){
                                $tiene= new HerramientaTiene();
                                $tiene->HE_ID=$prestamo->HE_ID;
                                $tiene->HT_CANTHEESTADO=0;
                                $tiene->EH_ID=3;
                            }
                            $tiene->HT_CANTHEESTADO=$tiene->HT_CANTHEESTADO+$prestamo->SOLI_CANTIDAD;
                            $tienelibre= HerramientaTiene::find()->where('HE_ID=:x AND EH_ID=:y',[':x'=>$prestamo->HE_ID, ':y'=>$libre->EH_ID])->one();
                            $tienelibre->HT_CANTHEESTADO=$tienelibre->HT_CANTHEESTADO-$prestamo->SOLI_CANTIDAD;
                            $tiene->save();
                            $tienelibre->save();*/
                            if (! ($flag = $prestamo->save(false))) {
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
        }else{
            return $this->render('create', [
                'model' => $model,
                'prestamo' => (empty($prestamo)) ? [new SpreHeSolicita] : $prestamo
            ]);
        }
    }

    /**
     * Updates an existing SolicitudPrestamo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->SPRE_ID]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing SolicitudPrestamo model.
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
     * Finds the SolicitudPrestamo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SolicitudPrestamo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SolicitudPrestamo::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionAprobar($id)
    {
            $model=$this->findModel($id);
        if($model->SPRE_ESTADO!='Aprobado'){
            $prestamos= SpreHeSolicita::find()->where(['SPRE_ID'=>$id])->all();

            foreach ($prestamos as $prestamo) {
            
                $tiene= HerramientaTiene::find()->where('HE_ID=:x AND EH_ID=:y',[':x'=>$prestamo->HE_ID, ':y'=>3])->one();

                if($tiene==NULL){
                    $tiene= new HerramientaTiene();
                    $tiene->HE_ID=$prestamo->HE_ID;
                    $tiene->HT_CANTHEESTADO=0;
                    $tiene->EH_ID=3;
                }
                $tiene->HT_CANTHEESTADO=$tiene->HT_CANTHEESTADO+$prestamo->SOLI_CANTIDAD;
                $tienelibre= HerramientaTiene::find()->where('HE_ID=:x AND EH_ID=:y',[':x'=>$prestamo->HE_ID, ':y'=>1])->one();
                $tienelibre->HT_CANTHEESTADO=$tienelibre->HT_CANTHEESTADO-$prestamo->SOLI_CANTIDAD;
                $tiene->save();
                $tienelibre->save();
            }
            $model->SPRE_ESTADO='Aprobado';
            $model->save();
            return $this->redirect(['index']);
        }else{
            
        }
    }

}
