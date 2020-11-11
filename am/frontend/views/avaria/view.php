<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Avaria */

$this->title = $model->idAvaria;
$this->params['breadcrumbs'][] = ['label' => 'Avarias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="avaria-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->idAvaria], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->idAvaria], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'data',
            'descricao',
            [
                'attribute' => 'idDispositivo',
                'label' => 'Dispositivo',
                'value' => $model->idDispositivo0->referencia,
            ],
            [
                'attribute' => 'tipo',
                'value' => $model->getTipo(),
            ],
            [
                'attribute' => 'gravidade',
                'value' => $model->getGravidade(),
            ],
            [
                'attribute' => 'estado',
                'value' => "",
                'contentOptions' => $model->getEstado(),
            ],
        ],
    ]) ?>

</div>
