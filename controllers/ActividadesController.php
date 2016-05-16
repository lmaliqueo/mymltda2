<?php

namespace app\controllers;

use Yii;
use app\models\Actividades;
use app\models\ActividadesSearch;
use app\models\OrdenTrabajo;
use app\models\ActSactAsigna;
use app\models\ManodeobraTrabajan;
use app\models\ContratoObrero;
use app\models\SueldoObrero;
use app\models\Persona;
use app\models\Model;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ActividadesController implements the CRUD actions for Actividades model.
 */
class ActividadesController extends Controller
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
     * Lists all Actividades models.
     * @return mixed
     */
    public function actionIndex($id)
    {
        $ordentrabajo= OrdenTrabajo::findOne($id);
        $searchModel = new ActividadesSearch();
        $searchModel->OT_ID=$id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->renderAjax('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'ordentrabajo' => $ordentrabajo,
        ]);
    }
    public function actionCalendario($id)
    {
      $fechaactual= date('Y-m-d');
        $orden= OrdenTrabajo::findOne($id);
        $actividades= Actividades::find()->where(['OT_ID'=>$orden->OT_ID])->all();
        $arreglo=[];
        foreach ($actividades as $actividad) {

              $act = new \yii2fullcalendar\models\Event();
              $act->id = $actividad->AC_ID;
              $act->title = $actividad->AC_NOMBRE;
              $act->start = $actividad->AC_FECHA_INICIO;
              $act->className = 'btn';
              $act->end = $actividad->AC_FECHA_TERMINO;
              if(($fechaactual>=$actividad->AC_FECHA_INICIO) && ($fechaactual<$actividad->AC_FECHA_TERMINO)){
                  if($actividad->AC_ESTADO=='Pendiente'){
                      $actividadactual= Actividades::find()->where(['AC_ID'=>$actividad->AC_ID])->one();
                      $actividadactual->AC_ESTADO='En proceso';
                      $actividadactual->save();
                  }
              }
              if($actividad->AC_ESTADO=='Finalizado'){
                  $act->color = '#5CB85C';
              }elseif ($actividad->AC_ESTADO=='En proceso') {
                  if($fechaactual > $actividad->AC_FECHA_TERMINO){
                      $act->color = '#f39c12';
                  }
              }elseif($actividad->AC_ESTADO=='Pendiente'){
                  $act->color = '#AFAFAF';

              }
              $arreglo[] = $act;
        }
        $searchModel = new ActividadesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->renderAjax('calendario', [
            'events' => $arreglo,
            'ordentrabajo' => $orden,
        ]);
    }

    /**
     * Displays a single Actividades model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model= $this->findModel($id);
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    public function actionViewModal($act, $ot)
    {
        $model=Actividades::find()->where(['AC_NOMBRE'=>$act])->andWhere(['OT_ID'=>$ot])->one();
        $subact= ActSactAsigna::find()->where(['AC_ID'=>$model->AC_ID])->all();
        $rutobreros= ManodeobraTrabajan::find()->select('PE_RUT')->where(['AC_ID'=>$model->AC_ID])->asArray()->all();
        $obreros= ContratoObrero::find()->where(['PE_RUT'=>$rutobreros])->andWhere(['PRO_ID'=>$model->oT->PRO_ID])->all();

        $sueldos=[];
        if ($obreros!=NULL) {
          foreach ($obreros as $ob) {
              $sueldo_ob = SueldoObrero::find()->where(['COO_ID'=>$ob->COO_ID])->orderBy(['COO_ID' => SORT_DESC])->one();
              $sueldos[]=$sueldo_ob;
          }
        }

        return $this->renderAjax('view', [
            'model' => $model,
            'subact' => $subact,
            'obreros' => $obreros,
            'sueldos' => $sueldos,
        ]);
    }
    public function actionViewAsginados($act)
    {
        $model=Actividades::find()->where(['AC_NOMBRE'=>$act])->one();
        $subact= ActSactAsigna::find()->where(['AC_ID'=>$model->AC_ID])->all();
        return $this->renderAjax('view', [
            'model' => $model,
            'subact' => $subact,
        ]);
    }

    /**
     * Creates a new Actividades model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        $model = new Actividades();
            $model->OT_ID=$id;

        if ($model->load(Yii::$app->request->post())) {
            $model->AC_ESTADO='Pendiente';
            $model->AC_COSTO_TOTAL=0;
            $model->save();
            return $this->redirect(['calendario', 'id' => $model->OT_ID]);
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        }
    }


    public function actionCrear($ot)
    {
        $model = new Actividades();
            $ordentrabajo= OrdenTrabajo::findOne($ot);
            $model->OT_ID=$ordentrabajo->OT_ID;

        if ($model->load(Yii::$app->request->post())) {
            $model->AC_ESTADO='Pendiente';
            $model->AC_COSTO_TOTAL=0;
            $model->save();
            return $this->redirect(['calendario', 'id' => $model->OT_ID]);
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
                'ordentrabajo' => $ordentrabajo,
            ]);
        }
    }



    /**
     * Updates an existing Actividades model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->AC_ID]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Actividades model.
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
     * Finds the Actividades model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Actividades the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Actividades::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    public function actionSubact($id)
    {

        $asignados= ActSactAsigna::find()->where(['AC_ID'=>$id])->all();
            return $this->render('sact-asignados', [
                'asignados' => $asignados,
           ]);


    }
    public function actionAsignarObreros($id)
    {
        $model= $this->findModel($id);
        $obrero_asignado= new ManodeobraTrabajan;
        $array_trabajan= ManodeobraTrabajan::find()->select('PE_RUT')->where(['AC_ID'=>$id])->asArray()->all();
        $trabajan= ContratoObrero::find()->where(['PE_RUT'=>$array_trabajan])->andWhere(['PRO_ID'=>$model->oT->PRO_ID])->all();
        $obreros= ContratoObrero::find()->select('PE_RUT')->where(['PRO_ID'=>$model->oT->PRO_ID])->asArray()->andWhere(['not in','PE_RUT',$array_trabajan])->all();

        $contratos= ContratoObrero::find()->where(['PRO_ID'=>$model->oT->PRO_ID])->all();

        $sueldos=[];
        if ($contratos!=NULL) {
          foreach ($contratos as $ob) {
              $sueldo_ob = SueldoObrero::find()->where(['COO_ID'=>$ob->COO_ID])->orderBy(['COO_ID' => SORT_DESC])->one();
              $sueldos[]=$sueldo_ob;
          }
        }




        if ($obrero_asignado->load(Yii::$app->request->post())) {

        } else {
            return $this->render('asignar_obreros', [
              'model' => $model,
              'trabajan' => $trabajan,
              'obreros' => $obreros,
              'sueldos' => $sueldos,
              'obrero_asignado' => $obrero_asignado,
            ]);
        }
    }

}
