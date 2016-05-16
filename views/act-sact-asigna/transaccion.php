<?php 
use yii\helpers\Html;
 


$this->title = $model->OT_NOMBRE;
$this->params['breadcrumbs'][] = ['label' => $model->pRO->PRO_NOMBRE, 'url' => ['proyecto/view', 'id'=>$model->PRO_ID]];
$this->params['breadcrumbs'][] = ['label' => 'Orden de Trabajos', 'url' => ['orden-trabajo/indexpro', 'id'=>$model->PRO_ID]];
$this->params['breadcrumbs'][] = $this->title;


 ?>
 <div class="page-header">

   <h1 class="text-center"><strong><?php echo $model->OT_NOMBRE ?></strong> </h1>
	</div>	

    <p>
        <?= Html::a('Agregar material', ['mat-prov-adquirido/transaccion'], ['class' => 'btn btn-success']) ?>
    </p>

<div class="row">
	<div class="col-md-4">

		<div class="panel panel-primary">
  <!-- Default panel contents -->
  <div class="panel-heading"><h4 class="text-center"><strong>Stock de Materiales</strong></h4></div>

<ul class="list-group">
  			<?php foreach ($stock as $row): ?>
  <li class="list-group-item">


		    <span class="badge"><?= $row->SM_CANTIDAD ?></span>
		<?= $row->mA->MA_NOMBRE ?>
  </li>
	<?php endforeach ?>
</ul>


	</div>	
<?php /*

	<h3 class="text-center">Materiales Reservados</h3>

	<table class="table table-bordered">
		<tr>
			<th>Material</th>
			<th>Stock por OT</th>
		</tr>
		<?php foreach ($cantidad as $row): ?>
		<tr>
						<td><?= $row->mA->MA_NOMBRE ?></td>
						<td><?= $row->CM_CANTIDAD ?></td>

		</tr>
	<?php endforeach ?>

	</table>

*/ ?>	

	</div>	
<div class="col-md-offset-5">

<div class="panel panel-info">
  <!-- Default panel contents -->
  <div class="panel-heading"><h4 class="text-center"><strong>Transaccion de Materiales</strong></h4></div>

	<table class="table table-bordered">
		<tr>
			<th>Material</th>
			<th>Cantidad</th>
			<th>Costo</th>
			<th>Proveedor</th>
			<th>Fecha</th>
		</tr>
		<?php foreach ($adquirido as $key): ?>
		<tr>
						<td><?= $key->mA->MA_NOMBRE ?></td>
						<td><?= $key->tM->TM_CANTIDAD ?></td>
						<td><?= $key->tM->TM_PRECIO ?></td>
						<td><?= $key->pROV->PROV_NOMBRE ?></td>
						<td><?= $key->tM->TM_FECHACOMPRA ?></td>

		</tr>
		<?php endforeach ?>


	</table>


	</div>
	</div>

</div>




