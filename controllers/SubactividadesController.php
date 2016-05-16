<?php

namespace app\controllers;

use Yii;
use app\models\Subactividades;
use app\models\SubactividadesSearch;
use app\models\SactMatConsume;
use app\models\SactHeOcupan;
use app\models\SactObRequiere;
use app\models\TipoMaterial;
use app\models\TipoHerramienta;
use app\models\TipoObrero;
use app\models\Model;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SubactividadesController implements the CRUD actions for Subactividades model.
 */
class SubactividadesController extends Controller
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
     * Lists all Subactividades models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SubactividadesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Subactividades model.
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
     * Creates a new Subactividades model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Subactividades();
        $subact_tiene= [new SactMatConsume];
            $model->SACT_COSTO=0;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {


            $subact_tiene = Model::createMultiple(SactMatConsume::classname());
            Model::loadMultiple($subact_tiene, Yii::$app->request->post());


            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($subact_tiene) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    //if ($flag = $model->save(false)) {
                        foreach ($subact_tiene as $subact_tienen) {
                            $subact_tienen->SACT_ID = $model->SACT_ID;
                            $material=Materiales::findOne($subact_tienen->MA_ID);
                            $subact_tienen->CONS_COSTO=$subact_tienen->CONS_CANTMATERIAL*$material->MA_COSTOUNIDAD;
                            $model->SACT_COSTO=$model->SACT_COSTO+$subact_tienen->CONS_COSTO;
                            if (! ($flag = $subact_tienen->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    //}
                    if ($flag) {
                        $transaction->commit();
                        $model->save();
                        return $this->redirect(['view', 'id' => $model->SACT_ID]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'subact_tiene' => (empty($subact_tiene)) ? [new SactMatConsume] : $subact_tiene

            ]);
        }
    }

    public function actionCrear()
    {
        $model=new Subactividades();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['asignar','id' => $model->SACT_ID]);
        } else {
            return $this->render('crear', [
                'model' => $model,
            ]);

        }

    }

    /**
     * Updates an existing Subactividades model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->SACT_ID]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Subactividades model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model=$this->findModel($id);
        $act_tienen= SactMatConsume::find()->where(['SACT_ID'=>$model->SACT_ID])->all();
        foreach ($act_tienen as $key) {

         $key->delete();
       }
        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Subactividades model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Subactividades the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Subactividades::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionAsignar($id)
    {
        $model= Subactividades::findOne($id);
        $mat_array= SactMatConsume::find()->select('TMA_ID')->where(['SACT_ID'=>$id])->asArray()->all();
        $he_array= SactHeOcupan::find()->select('TH_ID')->where(['SACT_ID'=>$id])->asArray()->all();
        $ob_array= SactObRequiere::find()->select('TOB_ID')->where(['SACT_ID'=>$id])->asArray()->all();

        $mat_asignados = SactMatConsume::find()->where(['SACT_ID'=>$id])->all();
        $he_asignados = SactHeOcupan::find()->where(['SACT_ID'=>$id])->all();
        $ob_asignados = SactObRequiere::find()->where(['SACT_ID'=>$id])->all();


        $asig_mat= new SactMatConsume();
        $asig_he= new SactHeOcupan();
        $asig_ob= new SactObRequiere();
        $materiales= TipoMaterial::find()->where(['not in','TMA_ID',$mat_array])->all();
        $herramientas= TipoHerramienta::find()->where(['not in','TH_ID',$he_array])->all();
        $obreros= TipoObrero::find()->where(['not in','TOB_ID',$ob_array])->all();
        if ($asig_mat->load(Yii::$app->request->post()) && $asig_he->load(Yii::$app->request->post()) && $asig_ob->load(Yii::$app->request->post())) {
            if($asig_mat->TMA_ID!=NULL){
                $asig_mat->SACT_ID=$model->SACT_ID;
                $asig_mat->save();
            }
            if($asig_he->TH_ID!=NULL){
                $asig_he->SACT_ID=$model->SACT_ID;
                $asig_he->save();
            }
            if($asig_ob->TOB_ID!=NULL){
                $asig_ob->SACT_ID=$model->SACT_ID;
                $asig_ob->save();
            }
            return $this->redirect(['asignar', 'id'=>$id]);
        } else {
            return $this->render('asignar_recursos', [
                'model' => $model,
                'asig_mat' => $asig_mat,
                'asig_he' => $asig_he,
                'asig_ob' => $asig_ob,
                'materiales' => $materiales,
                'herramientas' => $herramientas,
                'obreros' => $obreros,
                'mat_asignados' => $mat_asignados,
                'he_asignados' => $he_asignados,
                'ob_asignados' => $ob_asignados,
            ]);
        }
    }
}
