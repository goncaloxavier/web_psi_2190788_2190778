<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RelatorioPeca */

$this->title = 'Create Relatorio Peca';
$this->params['breadcrumbs'][] = ['label' => 'Relatorio Pecas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="relatorio-peca-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
