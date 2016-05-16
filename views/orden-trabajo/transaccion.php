<?php 
use yii\helpers\Html;
 use yii\helpers\Url;
use kartik\mpdf\Pdf;

use yii\bootstrap\Modal;
use dosamigos\datepicker\DateRangePicker;



$this->title = $model->pRO->PRO_NOMBRE;
$this->params['breadcrumbs'][] = ['label' => $model->pRO->PRO_NOMBRE, 'url' => ['proyecto/view', 'id'=>$model->PRO_ID]];
$this->params['breadcrumbs'][] = ['label' => 'Orden de Trabajos', 'url' => ['orden-trabajo/indexpro', 'id'=>$model->PRO_ID]];
$this->params['breadcrumbs'][] = $this->title;


 ?>
<h3 class="header">Materiales</h3>
<br>
<div class="row">
	<div class="col-md-4">
	    <p>
	        <?= Html::a('Generar Informe', ['informe-mat', 'idot' => $model->OT_ID], ['class' => 'btn btn-flat btn-primary btn-block', 'target'=>'_blank']) ?>
	    </p>
	</div>
	<div class="col-md-8">
		<?= DateRangePicker::widget([
		    'name' => 'date_from',
		    'value' => date('Y-m-d'),
		    'nameTo' => 'name_to',
		    'valueTo' => date('Y-m-d'),
    		'language' => 'es',
	        'clientOptions' => [
	            'autoclose' => true,
	            'format' => 'yyyy-mm-dd'
	        ]
		]);?>
	</div>
</div>
		<?php /*
		*/ ?>

<?php 
    Modal::begin([
            'header'=>'<h4>Transaccion</h4>',
            'id'=>'modalInforme',
            'size'=>'modal-lg',
        ]);
    echo "<div class='modalContent'></div>";
    Modal::end();
 ?>

<br>


<div class="row">
	<div class="col-md-4">


<div class="box box-primary">
<div class="box-header with-border"><h4 class="box-title">Stock de Materiales</h4></div>
<div class="box-body no-padding">
	<ul class="nav nav-pills nav-stacked">
		<?php foreach ($stock as $row) { ?>
			<li class="stock" idstock="<?php echo $row->SM_ID; ?>" idmat="<?php echo $row->MA_ID; ?>"><a href="#"><?= $row->mA->MA_NOMBRE ?> <span class="badge bg-blue pull-right"><?= $row->SM_CANTIDAD ?></span></a></li>
		<?php } ?>
	</ul>
</div>
</div>


<?php /*
	<div class="panel panel-primary">
			<div class="panel-heading"><h4 class="text-center"><strong>Stock de Materiales</strong></h4></div>
			<ul class="list-group">
			  			<?php foreach ($stock as $row): ?>
			  <li class="list-group-item btn" style="text-align:left; padding-left:10px">


					    <span class="badge bg-blue"><?= $row->SM_CANTIDAD ?></span>
					<span class="stock"><?= $row->mA->MA_NOMBRE ?></span>
			  </li>
				<?php endforeach ?>
			</ul>
	</div>	
*/ ?>
<br>

<?php if($adjunta!=NULL){ ?>
		<div class="panel panel-danger">
  <!-- Default panel contents -->
  <div class="panel-heading"><h4 class="text-center"><strong>Pedido de Materiales Pendientes</strong></h4></div>

<ul class="list-group">
  			<?php foreach ($adjunta as $pedidoadjunta): ?>
  <li class="list-group-item btn" style="text-align:left; padding-left:10px">


		    <span class="badge bg-red"><?= $pedidoadjunta->PA_CANTIDADMAT ?></span>
		 <span class="pedido"><?= $pedidoadjunta->sM->mA->MA_NOMBRE ?></span>
  </li>
	<?php endforeach ?>

</ul>


	</div>	

<?php }  ?>	




	</div>	
<div class="col-md-8">

<div id="contenidomat">


	<div class="box box-info">
		<div class="box-header with-border"><h4 class="box-title">Transacciones</h4></div>
		<div class="box-body no-padding">
			<table class="table table-hover">




				<tbody>

				<tr class="bg-light-blue">

					<th>Material</th>
					<th>Proveedor</th>
					<th>Fecha</th>
					<th>Cantidad</th>
					<th>Costo</th>
				</tr>
				<?php foreach ($adquirido as $key): ?>
				<tr>
					<td><?= $key->mA->MA_NOMBRE ?></td>
					<td><?= $key->pROV->PROV_NOMBRE ?></td>
					<td><?= $key->tM->TM_FECHACOMPRA ?></td>
					<td><?= $key->tM->TM_CANTIDAD ?></td>
					<td><?= $key->tM->TM_PRECIO ?></td>

				</tr>

				<?php endforeach ?>
				</tbody>

			</table>



		</div>
	</div>
	<?php /*
	<div class="panel panel-info">
	  <!-- Default panel contents -->
	  <div class="panel-heading"><h4 class="text-center"><strong>Transaccion de Materiales</strong></h4></div>

		<table class="table table-hover table-bordered">



		 <?php foreach ($stock as $row): ?>

			<tbody>
			<tr>
				<th colspan="4" class="text-center success"><?= $row->mA->MA_NOMBRE ?></th>
			</tr>
			<tr class="active">

				<th>Proveedor</th>
				<th>Fecha</th>
				<th>Cantidad</th>
				<th>Costo</th>
			</tr>
			<?php foreach ($adquirido as $key): ?>
			<?php if($row->MA_ID == $key->MA_ID){ ?>
			<tr>
				<td><?= $key->pROV->PROV_NOMBRE ?></td>
				<td><?= $key->tM->TM_FECHACOMPRA ?></td>
				<td><?= $key->tM->TM_CANTIDAD ?></td>
				<td><?= $key->tM->TM_PRECIO ?></td>

			</tr>

			<?php } ?>
			<?php endforeach ?>
			<tr>
				<th colspan="2" class="text-right warning">Total:</th>
				<th class="warning"><?= $row->SM_CANTIDAD ?></th>
				<th class="warning"></th>
			</tr>
			<?php endforeach ?>
			</tbody>

		</table>
	</div>*/ ?>
</div>
	</div>

</div>


<?php 
$script = <<< JS
    $('.stock').click(function(){
        var idstock= $(this).attr('idstock');
        var idmat= $(this).attr('idmat');
        $('li').each(function () {
            $(this).removeClass('active');
        })
        $(this).addClass('active');

            $.get('index.php?r=orden-trabajo/get-movimientos',{ idstock : idstock, idmat : idmat }, function(data){
                $('#contenidomat').empty();
                $('#contenidomat').append(data);
            })
    });
    $('.pedido').click(function(){
        var mat = $(this).text();
        var ot = $('#ot').text();

            $.get('index.php?r=orden-trabajo/get-pedidos',{ mat : mat, ot : ot }, function(data){
                 $('#contenidomat').empty();
                $('#contenidomat').append(data);
            })
    });

	$('#informe').click(function() {
		$('#modalInforme').modal('show')
		.find('.modalContent')
		.load($(this).attr('value'));
	});

JS;
$this->registerJs($script);
?>


