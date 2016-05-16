<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Actividades */

$this->title = 'Crear Actividad';
$this->params['breadcrumbs'][] = ['label' => 'Actividades', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="actividades-create">
	<?php /*
    <h1><?= Html::encode($this->title) ?></h1>
	*/ ?>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
