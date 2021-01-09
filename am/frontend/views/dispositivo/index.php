<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DispositivoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Listagem de Dispositivos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dispositivo-index">

    <h2><?= Html::encode($this->title) ?></h2>

    <p align="right">
        <?= Html::a('+', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'dataCompra',
            'referencia',
            [
                'attribute' => 'estado',
                'value' => function ($model) {
                    return "";
                },
                'contentOptions' => function ($model) {
                    return $model->getEstado();
                }
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
