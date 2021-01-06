<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PecaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pecas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="peca-index">

    <h2><?= Html::encode($this->title) ?></h2>

    <p align="right">
        <?= Html::a('+', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'idPeca',
            'descricao',
            'custo',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
