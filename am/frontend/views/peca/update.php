<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Peca */

$this->title = 'Update Peca: ' . $model->idPeca;
$this->params['breadcrumbs'][] = ['label' => 'Pecas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idPeca, 'url' => ['view', 'id' => $model->idPeca]];
$this->params['breadcrumbs'][] = 'Update';
?>
<h2><?= Html::encode($this->title) ?></h2>
<div class="peca-update" align="center">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
