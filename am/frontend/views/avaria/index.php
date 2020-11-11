<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AvariaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Avarias';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="avaria-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Avaria', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'data',
            'descricao',
            [
                'attribute' => 'idDispositivo',
                'label' => 'Dispositivo',
                'value' => function ($model) {
                    return $model->idDispositivo0->referencia;
                },
            ],
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
