<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RelatorioPecaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Relatorio Pecas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="relatorio-peca-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Relatorio Peca', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idRelatorio',
            'idPeca',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
