<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Avaria */

$this->title = 'Update Avaria: ' . $model->idAvaria;
$this->params['breadcrumbs'][] = ['label' => 'Avarias', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idAvaria, 'url' => ['view', 'id' => $model->idAvaria]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="avaria-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formUpdate', [
        'model' => $model,
    ]) ?>

</div>
