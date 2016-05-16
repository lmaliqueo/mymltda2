<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use app\models\Persona;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\UsuariosControla */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="usuarios-controla-form">

    <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($encargado, 'PE_RUT')->widget(Select2::classname(), [
                'data' => ArrayHelper::map($encargados,'PE_RUT','PE_NOMBRES', 'PE_APELLIDOPAT'),
                'language' => 'es',
                'options' => ['placeholder' => 'Selecionar Encargado'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
            ?>

    <div class="form-group">
        <?= Html::submitButton($encargado->isNewRecord ? 'Asignar' : 'Update', ['class' => $encargado->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
