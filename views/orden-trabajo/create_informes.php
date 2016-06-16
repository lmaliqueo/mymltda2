<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Modal;

?>
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
