<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\models\Bodegas;
use app\models\Proveedor;
use app\models\TipoHerramienta;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Herramientas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="herramientas-form">

    <?php $form = ActiveForm::begin(); ?>


<div class="row pull-center">
    <div class="col-md-4">
        <?= $form->field($model, 'HE_ID')->textInput(['maxlength' => true, 'disabled'=> $model->isNewRecord ? false : true]) ?> 
    </div>
    <div class="col-md-8">
        <?= $form->field($model, 'TH_ID')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(TipoHerramienta::find()->all(),'TH_ID','TH_NOMBRE'),
            'language' => 'es',
            'options' => ['placeholder' => 'Selecionar tipo de herramienta',  'disabled'=> $model->isNewRecord ? false : true, 'id'=>$model->isNewRecord ? 'tipo_new' : 'tipo_exist'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
        ?>
    </div>
</div>
        <?= $form->field($model, 'HE_DESCRIPCION')->textInput(['maxlength' => true]) ?>

        
        <?= $form->field($model, 'PROV_ID')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(Proveedor::find()->all(),'PROV_ID','PROV_NOMBRE'),
            'language' => 'es',
            'options' => ['placeholder' => 'Selecionar Proveedor', 'id'=>$model->isNewRecord ? 'prov_new' : 'prov_exist'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
        ?>
        <?= $form->field($model, 'BO_ID')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(Bodegas::find()->all(),'BO_ID','BO_NOMBRE'),
            'language' => 'es',
            'options' => ['placeholder' => 'Selecionar Bodega', 'id'=>$model->isNewRecord ? 'bo_new' : 'bo_exist'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
        ?>
        <?= $form->field($model, 'HE_COSTOUNIDAD')->textInput() ?>





    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Ingresar' : 'Guardar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
