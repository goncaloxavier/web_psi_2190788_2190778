<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Relatorio */

$this->title = 'Update Relatorio: ' . $model->idRelatorio;
$this->params['breadcrumbs'][] = ['label' => 'Relatorios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idRelatorio, 'url' => ['view', 'id' => $model->idRelatorio]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="relatorio-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
