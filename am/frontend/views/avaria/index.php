<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AvariaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Listagem de Avarias';
$this->params['breadcrumbs'][] = $this->title;
$numAvarias = \app\models\Avaria::find()->all();
?>
<div class="avaria-index">

    <h2><?= Html::encode($this->title.' ('.sizeof($numAvarias).')') ?></h2>

    <p align="right">
        <?= Html::a('+', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'attribute' => 'idUtilizador',
                'label' => 'Autor',
                'value' => function ($model) {
                    return $model->idUtilizador0->nomeUtilizador;
                },
            ],
            'descricao',
            [
                'attribute' => 'idDispositivo',
                'label' => 'Dispositivo',
                'value' => function ($model) {
                    return $model->idDispositivo0->referencia;
                },
            ],
          'data',
            [
                'attribute' => 'estado',
                'label' => 'Estado Reparacao',
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
