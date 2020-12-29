<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Avaria */

$this->title = 'Update Avaria: ' . $model->idAvaria;
$this->params['breadcrumbs'][] = ['label' => 'Avarias', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idAvaria, 'url' => ['view', 'id' => $model->idAvaria]];
$this->params['breadcrumbs'][] = 'Update';
?>
<h2><?= Html::encode($this->title) ?></h2>
<div class="avaria-update" align="center">
    <?= $this->render('_formUpdate', [
        'model' => $model,
    ]) ?>

</div>
