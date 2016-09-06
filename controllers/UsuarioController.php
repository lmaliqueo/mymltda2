<?php

namespace app\controllers;

use Yii;
use app\models\Usuario;
use app\models\Persona;
use app\models\UsuarioSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UsuarioController implements the CRUD actions for Usuario model.
 */
class UsuarioController extends Controller
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
     * Lists all Usuario models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UsuarioSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Usuario model.
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
     * Creates a new Usuario model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Usuario();
        $persona = new Persona();

        if ($model->load(Yii::$app->request->post()) && $persona->load(Yii::$app->request->post())) {
            $model->US_PASSWORD = md5($model->US_PASSWORD);
            $model->PE_RUT = $persona->PE_RUT;
            if($persona->save(false)){
                $model->save();
                $this->asignarRol($model);
                return $this->redirect(['index']);
            }else{
                \Yii::$app->getSession()->setFlash('success', 'El usuario '.$model->US_USERNAME.' a sido ingresado exitosamente');
                return $this->redirect(['index']);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'persona' => $persona,
            ]);
        }
    }

    /**
     * Updates an existing Usuario model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $persona = Persona::findOne($model->PE_RUT);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->US_ID]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Usuario model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $this->retirarRol($model);
        $persona = Persona::findOne($model->PE_RUT);
        $model->delete();
        $persona->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Usuario model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Usuario the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Usuario::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function asignarRol($model)
    {
        $auth = Yii::$app->authManager;
        $rol = $model->pERUT->cA->CA_NOMBRECARGO;


        $item = $auth->getRole($rol);
        $item = $item ? : $auth->getPermission($rol);
        $auth->assign($item, $model->US_ID);

        //$auth->assign($rol, $id);
        \Yii::$app->getSession()->setFlash('success', 'El usuario '.$model->US_USERNAME.' a sido ingresado exitosamente');
        return;
    }

    protected function retirarRol($model)
    {
        $auth = Yii::$app->authManager;
        $rol = $model->pERUT->cA->CA_NOMBRECARGO;


        $item = $auth->getRole($rol);
        $item = $item ? : $auth->getPermission($rol);
        $auth->revoke($item, $model->US_ID);

        //$auth->assign($rol, $id);
        \Yii::$app->getSession()->setFlash('info', 'El usuario "'.$model->US_USERNAME.'" a sido eliminado');
        return;
    }

    public function actionVerPerfil()
    {
        $model = Usuario::findOne(Yii::$app->user->id);
        $persona = Persona::findOne($model->PE_RUT);
        return $this->render('view', [
            'model' => $model,
            'persona' => $persona,
        ]);
    }

    public function actionCambiarPassword()
    {
        $model = Usuario::findOne(Yii::$app->user->id);
        $persona = Persona::findOne($model->PE_RUT);
        if ($model->load(Yii::$app->request->post()) && $persona->load(Yii::$app->request->post())) {

        } else {
            return $this->render('update_pw', [
                'model' => $model,
                'persona' => $persona,
            ]);
        }
    }



    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPassword($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->getRequest()->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->getSession()->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
                'model' => $model,
        ]);
    }



}
