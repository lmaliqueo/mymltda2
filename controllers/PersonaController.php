<?php

namespace app\controllers;

use Yii;
use app\models\Persona;
use app\models\PersonaSearch;
use app\models\ManodeobraTrabajan;
use app\models\Actividades;
use app\models\Cargo;
use app\models\ActSactAsigna;
use app\models\ContratoObrero;
use app\models\SueldoObrero;
use app\models\OrdenTrabajo;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\helpers\Json;

/**
 * PersonaController implements the CRUD actions for Persona model.
 */
class PersonaController extends Controller
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
     * Lists all Persona models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PersonaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $cargo=0;
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'cargo'=> $cargo,
        ]);
    }
    public function actionIndexObrero()
    {
        $searchModel = new PersonaSearch();
        $cargo=4;
        $searchModel->CA_ID = 4;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);


        $cargo_obrero = Cargo::find()->where(['CA_NOMBRECARGO'=>'Mano de Obra'])->one();
        $searchModel = new Persona();
        $dataProvider = new ActiveDataProvider([
            'query' => Persona::find()->
                where(['CA_ID'=>$cargo_obrero->CA_ID]),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);


        return $this->render('index_obrero', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'cargo'=> $cargo,

        ]);
    }

    public function actionIndexEncargado()
    {
        $searchModel = new PersonaSearch();
        $cargo=3;
        $searchModel->CA_ID = 3;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index_encargado', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'cargo'=> $cargo,
        ]);
    }

    /**
     * Displays a single Persona model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Persona model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Persona();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->PE_RUT]);
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionCreateEncargado()
    {
        $model = new Persona();
        $model->CA_ID=3;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index-encargado']);
        } else {
            return $this->renderAjax('_formencargado', [
                'model' => $model,
            ]);
        }
    }

    public function actionCreateObrero()
    {
        $model = new Persona();
        $contrato = new ContratoObrero();
        $sueldo = new SueldoObrero();
        $model->CA_ID=4;
        if ($model->load(Yii::$app->request->post()) && $contrato->load(Yii::$app->request->post()) && $sueldo->load(Yii::$app->request->post())) {
            $model->CA_ID=4;
            $model->save();
            $contrato->PE_RUT=$model->PE_RUT;
            $contrato->COO_FECHA= date('Y-m-d');
            $contrato->save();
            $sueldo->SU_FECHA= date('Y-m-d');
            $sueldo->COO_ID=$contrato->COO_ID;
            $sueldo->save();

            return $this->redirect(['index-obrero', 'id' => $model->PE_RUT]);
        } else {
            return $this->renderAjax('createobrero', [
                'model' => $model,
                'contrato' => $contrato,
                'sueldo' => $sueldo,
            ]);
        }
    }

    public function actionAsignarAct($id, $proyecto)
    {
        $obrero= Persona::findOne($id);
        $contrato= ContratoObrero::find()->where(['PE_RUT'=>$id, 'PRO_ID'=>$proyecto])->orderBy(['COO_FECHA'=>SORT_DESC])->one();
        $model= new ManodeobraTrabajan();
        $arrayasignados = ManodeobraTrabajan::find()->select('AC_ID')->where(['PE_RUT'=>$id])->asArray()->all();
        $asignados = Actividades::find()->where(['AC_ID'=>$arrayasignados])->orderBy(['AC_FECHA_TERMINO'=>SORT_DESC])->all();
        $otid= OrdenTrabajo::find()->select('OT_ID')->where(['PRO_ID'=>$proyecto])->asArray()->all();
        if($arrayasignados!=NULL){
            $actividades = Actividades::find()->where(['not in','AC_ID',$arrayasignados])->andWhere(['not in','AC_ESTADO','Finalizado'])->andWhere(['OT_ID'=>$otid])->all();
        }else{
            $actividades = Actividades::find()->where(['not in','AC_ESTADO','Finalizado'])->andWhere(['OT_ID'=>$otid])->all();
        }
        $ordenes= OrdenTrabajo::find()->where(['PRO_ID'=>$proyecto])->all();
        $orden= new OrdenTrabajo();
        $sueldo = SueldoObrero::find()->where(['COO_ID'=>$contrato->COO_ID])->orderBy(['SU_ID'=>SORT_DESC])->one();
        /*if ($model->load(Yii::$app->request->post())) {
            $model->PE_RUT=$id;
            $model->save();
            return $this->redirect(['asignar-act', 'id' => $id, 'proyecto' =>$proyecto]);
        } else {*/
            return $this->render('asignar', [
                'model' => $model,
                'ordenes' => $ordenes,
                'orden' => $orden,
                'asignados' => $asignados,
                'contrato' => $contrato,
                'sueldo' => $sueldo,
            ]);
        /*}*/
    }

    /**
     * Updates an existing Persona model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */

    public function actionAsignaModal($act, $ot)
    {
        $model=Actividades::find()->where(['AC_NOMBRE'=>$act])->andWhere(['OT_ID'=>$ot])->one();
        $subact= ActSactAsigna::find()->where(['AC_ID'=>$model->AC_ID])->all();
        return $this->renderAjax('actividad', [
            'model' => $model,
            'subact' => $subact,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->PE_RUT]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionUpdateEncargado($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->PE_RUT]);
        } else {
            return $this->renderAjax('_formencargado', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Persona model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Persona model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Persona the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Persona::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionGetCalendario($rut, $ot)
    {
        $idact= ManodeobraTrabajan::find()->select('AC_ID')->where(['PE_RUT'=>$rut])->asArray()->all();
        if($idact!=NULL){
            $asignados= Actividades::find()->where(['AC_ID'=>$idact])->all();
        }else{
            $asignados=NULL;
        }
        $actividades= Actividades::find()->where(['OT_ID'=>$ot])->all();
        $orden= OrdenTrabajo::findOne($ot);


        $arreglo=$this->viewCalendario($ot, $asignados);
/*
        $arreglo=[];
        foreach ($actividades as $actividad) {

            $act = new \yii2fullcalendar\models\Event();
            $act->id = $actividad->AC_ID;
            $act->title = $actividad->AC_NOMBRE;
            $act->start = $actividad->AC_FECHA_INICIO;
            $act->className = 'btn hola';
            if($actividad->AC_ESTADO=='Finalizado'){
                $act->className = 'btn disabled';
            }else{
                $act->className = 'btn hola';                
            }
            $act->end = $actividad->AC_FECHA_TERMINO;
            if ($asignados!=NULL) {
                foreach ($asignados as $asignado) {
                    if($asignado->AC_ID==$actividad->AC_ID){
                        $act->color = '#f39c12';                    
                    }else{
                        $act->color = '#AFAFAF';                
                    }
                }
            }elseif($actividad->AC_ESTADO!='Finalizado'){
                $act->color = '#AFAFAF';                
            }else{
                  $act->color = '#5CB85C';                
            }
            $arreglo[] = $act;
        }*/
        return $this->renderAjax('calendario', [
            'events' => $arreglo,
            'ordentrabajo' => $orden,
        ]);

    }

    protected function viewCalendario(/*$id, $asignados*/$actividades){
        //$fechaactual= date('Y-m-d');
        //$actividades= Actividades::find()->where(['OT_ID'=>$id])->all();
        $arreglo=[];
        foreach ($actividades as $actividad) {

            $act = new \yii2fullcalendar\models\Event();
            $act->id = $actividad->AC_ID;
            $act->title = $actividad->AC_NOMBRE;
            $act->start = $actividad->AC_FECHA_INICIO;
            $act->className = 'btn hola';
            if($actividad->AC_ESTADO=='Finalizado'){
                $act->className = 'btn disabled';
            }else{
                $act->className = 'btn hola';                
            }
            $act->end = $actividad->AC_FECHA_TERMINO;
            if ($asignados!=NULL) {
                foreach ($asignados as $asignado) {
                    if($asignado->AC_ID==$actividad->AC_ID){
                        $act->color = '#f39c12';                    
                    }else{
                        $act->color = '#AFAFAF';                
                    }
                }
            }elseif($actividad->AC_ESTADO!='Finalizado'){
                $act->color = '#AFAFAF';                
            }else{
                  $act->color = '#5CB85C';                
            }
            $arreglo[] = $act;
        }
        return $arreglo;
    }


    public function actionModificarSueldo($id){
        $contrato= ContratoObrero::findOne($id);
        $ult_sueldo= SueldoObrero::find()->where(['COO_ID'=>$id])->orderBy(['SU_ID'=>SORT_DESC,])->one();
        $model= new SueldoObrero();

        if ($model->load(Yii::$app->request->post())) {
            $model->COO_ID= $contrato->COO_ID;
            $model->SU_FECHA= date('Y-m-d');
            $model->save();
            return $this->redirect(['index-obrero', 'id' => $contrato->PE_RUT]);
        } else {
            return $this->renderAjax('_sueldo', [
                'model' => $model,
                'contrato' => $contrato,
                'ult_sueldo' => $ult_sueldo,
            ]);
        }
    }

    public function actionVerContratoOb($rut)
    {
        $obrero= Persona::findOne($rut);
        $contrato = ContratoObrero::find()->where(['PE_RUT'=>$rut])->orderBy(['COO_ID'=>SORT_DESC])->one();
        $sueldo = SueldoObrero::find()->where(['COO_ID'=>$contrato->COO_ID])->orderBy(['SU_ID'=>SORT_DESC])->one();
        return $this->renderAjax('view_contrato_ob', [
            'obrero' => $obrero,
            'contrato' => $contrato,
            'sueldo' => $sueldo,
        ]);

    }
    public function actionCrearContratoOb($rut)
    {
        $obrero= Persona::findOne($rut);
        $contrato = new ContratoObrero();
        $sueldo = new SueldoObrero();
        $contrato->COO_FECHA = date('Y-m-d');
        if ($contrato->load(Yii::$app->request->post()) && $sueldo->load(Yii::$app->request->post())) {

            $contrato->PE_RUT=$obrero->PE_RUT;
            $contrato->save();
            $sueldo->SU_FECHA= date('Y-m-d');
            $sueldo->COO_ID=$contrato->COO_ID;
            $sueldo->save();
            return $this->redirect(['index-obrero', 'id' => $obrero->PE_RUT]);

        } else {
            return $this->renderAjax('_contrato', [
                'obrero' => $obrero,
                'contrato' => $contrato,
                'sueldo' => $sueldo,
            ]);
        }
    }
    public function actionVerProyecto($rut)
    {
        $obrero = $this->findModel($rut);
        $array_asignados = ManodeobraTrabajan::find()->select('AC_ID')->where(['PE_RUT'=>$rut])->asArray()->all();
        $actividades = Actividades::find()->where(['AC_ID'=>$array_asignados])->all();
        $arreglo = $this->viewCalendario($actividades);
        return $this->renderAjax('calendario', [
            'events' => $arreglo,
        ]);


    }

}
