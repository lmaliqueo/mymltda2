<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Subactividades */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="subactividades-form">

    <?php $form = ActiveForm::begin(); ?>

    <h3><?= $model->SACT_NOMBRE ?></h3>
    <br>
    <div class="form-group">
        <?= Html::submitButton('Asignar', ['class' => 'btn btn-success']) ?>
    </div>
<div class="row">


	<div class="col-md-4">
		<div class="box box-info">
			<div class="box-header with-border"><h4 class="box-title">Materiales</h4></div>
			<div class="box-body">
				<div class="row">
					<div class="col-sm-3">
						<?= $form->field($asig_mat, 'CONS_CANTIDAD')->textInput(['type' => 'number', 'maxlength' => true]) ?>
					</div>
					<div class="col-sm-9">
						<?= $form->field($asig_mat, 'TMA_ID')->widget(Select2::classname(), [
						    'data' => ArrayHelper::map($materiales,'TMA_ID','TMA_NOMBRE'),
						    'language' => 'es',
						    'options' => ['placeholder' => 'Selecionar tipo de material', 'id'=>'maID'],
						    'pluginOptions' => [
						        'allowClear' => true
						    ],
						]);
						?>
					</div>
				</div>

			</div>
			<div class="box-footer">
					<?php if ($mat_asignados!=NULL) { ?>
						<table class="table table-condensed">
							<tr class="bg-aqua">
								<th>Tipo de Material</th>
								<th>Cantidad</th>
							</tr>
                <tbody class="table table-bordered">

							<?php foreach ($mat_asignados as $mat) { ?>								
								<tr>
									<td><?= $mat->tMA->TMA_NOMBRE ?></td>
									<td><?= $mat->CONS_CANTIDAD ?></td>
								</tr>
							<?php } ?>
                </tbody>
						</table>

					<?php } ?>
			</div>
		</div>
	</div>
		<div class="col-md-4">
		<div class="box box-success">
			<div class="box-header with-border"><h4 class="box-title">Obreros</h4></div>
			<div class="box-body">
				<div class="row">
					<div class="col-sm-3">
						<?= $form->field($asig_ob, 'RE_CANTIDAD')->textInput(['type' => 'number', 'maxlength' => true]) ?>
					</div>
					<div class="col-sm-9">

						<?= $form->field($asig_ob, 'TOB_ID')->widget(Select2::classname(), [
						    'data' => ArrayHelper::map($obreros,'TOB_ID','TOB_NOMBRE'),
						    'language' => 'es',
						    'options' => ['placeholder' => 'Selecionar tipo de obrero', 'id'=>'obID'],
						    'pluginOptions' => [
						        'allowClear' => true
						    ],
						]);
						?>
					</div>
				</div>


			</div>
			<div class="box-footer">
				<?php if ($ob_asignados!=NULL) { ?>
					<table class="table table-condensed">
						<tr class="bg-green">
							<th>Obreros</th>
							<th>Cantidad</th>
						</tr>
                <tbody class="table table-bordered">

						<?php foreach ($ob_asignados as $ob) { ?>								
							<tr>
								<td><?= $ob->tOB->TOB_NOMBRE ?></td>
								<td><?= $ob->RE_CANTIDAD ?></td>
							</tr>
                </tbody>
						<?php } ?>
					</table>

				<?php } ?>
			</div>
		</div>
	</div>
	
</div>




    <?php ActiveForm::end(); ?>

</div>
