<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ReportesAvances */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reportes-avances-form">

    <?php $form = ActiveForm::begin(); ?>


<div class="box box-solid">
	<div class="box-header with-border">
		<h3 class="no-margin">
			Nuevo Reporte de Avances
			<span class="pull-right">
        		<?= Html::submitButton($model->isNewRecord ? 'Ingresar Reporte' : 'Guardar', ['class' => $model->isNewRecord ? 'btn bg-green btn-flat' : 'btn bg-blue btn-flat']) ?>
			</span>
		</h3>
	</div>
	<div class="box-body">
		<div class="box box-primary">
			<div class="box-body">
			    <div class="row">
			    	<div class="col-md-8">
					    <?= $form->field($model, 'RA_TITULO')->textInput(['maxlength' => true,]) ?>
			    	</div>
			    	<div class="col-md-4">
					    <?= $form->field($model, 'RA_FECHA')->textInput(['disabled'=>true]) ?>
			    	</div>
			    </div>

			    <?= $form->field($model, 'RA_DESCRIPCION')->textarea(['rows' => 6]) ?>

			</div>
		</div>


		<div class="box box-primary">
			<div class="box-header with-border">
				<h4 class="box-title">Avances</h4>
			</div>
			<div class="box-body">
				<table class="table table-bordered">
					<tr class="bg-light-blue">
						<th>Item</th>
						<th>Cantidad Contratada</th>
						<th>Cantidad Actual</th>
						<th>Progreso</th>
						<th class="text-center">%</th>
						<th class="bg-blue">Cantidad Avanzada</th>
					</tr>
					<?php 
						foreach ($subact as $item) {
							foreach ($arreglo as $count => $acumula) { 
							$promedio= ($item->AS_CANTIDADACTUAL*100)/$item->AS_CANTIDAD; ?>
								<?php if ($item->AS_ID == $acumula->AS_ID) { 
									$disabled = false;
									$color='danger';
									$color_2='bg-red';
									if(($item->AS_CANTIDAD - $item->AS_CANTIDADACTUAL)==0){
										$disabled = true;
										$color='success';
										$color_2='bg-green';
									} ?>

									<tr>
										<td><?= $item->sACT->SACT_NOMBRE ?></td>
										<td><?= $item->AS_CANTIDAD ?></td>
										<td><?= $item->AS_CANTIDADACTUAL ?></td>
										<td><div class="progress progress-xs"><div class="progress-bar progress-bar-<?php echo $color; ?>" style="width: <?php echo $promedio; ?>%"></div></div></td>
										<td><span class="badge <?php echo $color_2; ?>"><?php echo $promedio; ?>%</span></td>
										<td class="warning">
										
										<?php
										 	echo $form->field($acumula, '['.$count.']AA_CANTIDAD')
		                            			->textInput([
		                            					'type' => 'number',
		                        						'class' => 'form-control cantidad_avance input-sm',
		                        						'min'=>0,
		                        						'max'=>($item->AS_CANTIDAD - $item->AS_CANTIDADACTUAL),
		                        						'disabled' => $disabled,
		                        					])
		                            			->label(false);
											break;
										 } ?>
										</td>
									</tr>
					<?php 	}
						} ?>
				</table>
			</div>
		</div>
	</div>
</div>




    <div class="form-group">
    </div>

    <?php ActiveForm::end(); ?>

</div>
