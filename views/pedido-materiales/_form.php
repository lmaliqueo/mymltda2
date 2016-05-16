<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use app\models\StockMateriales;

/* @var $this yii\web\View */
/* @var $model app\models\PedidoMateriales */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pedido-materiales-form">

    <?php $form = ActiveForm::begin(); ?>



    <?= $form->field($model, 'PM_DESCRIPCION')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PM_TEXTO')->textarea(['rows' => 6]) ?>


    <div class="row">
        <div class="col-sm-6">


            <?= $form->field($adjunta, 'PA_CANTIDADMAT')->textInput() ?>
        </div>
        <div class="col-sm-6">


            <?= $form->field($adjunta, 'SM_ID')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(StockMateriales::find()->all(),'SM_ID','mA.MA_NOMBRE'),
                'language' => 'es',
                'options' => ['placeholder' => 'Selecionar material', 'id'=>'matID'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
            ?>

        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
