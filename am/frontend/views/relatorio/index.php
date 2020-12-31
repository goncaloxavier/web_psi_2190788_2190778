<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RelatorioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Relatorios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="relatorio-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'idRelatorio',
            'idAvaria',
            [
                'attribute' => 'idDispositivo',
                'label' => 'Dispositivo',
                'value' => function ($model) {
                    return $model->idAvaria0->idDispositivo0->referencia;
                },
            ],
            'descricao',
            [
                'attribute' => 'idUtilizador',
                'label' => 'Autor',
                'value' => function ($model) {
                    return $model->getAutor();
                },
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
