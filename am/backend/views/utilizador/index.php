<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\UtilizadorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Listagem de Utilizadores';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="utilizador-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p align="right">
        <?php
        if($estado == 1){
            echo Html::a('Inativos', ['index', 'estado' => 0], ['class' => 'btn btn-primary']);
        }else{
            echo Html::a('Ativos', ['index', 'estado' => 1], ['class' => 'btn btn-primary']);
        }
        ?>
        <?= Html::a('+', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'idUtilizador',
            'nomeUtilizador',
            'palavraPasse',
            'email:email',
            'tipo',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
