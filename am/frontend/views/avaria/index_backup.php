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

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php /*GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'data',
            'descricao',
            'tipo',
            'estado',
            'gravidade',
            //'data',
            //'idDispositivo',
            //'idRelatorio',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);*/ ?>

    <table>
        <?php
            $avarias = \app\models\Avaria::find()->all();
            foreach ($avarias as $avaria) {
                $dispositivo = $avaria->getIdDispositivo0();
        ?>
            <th>Data</th><th>Descricao</th><th>Dispositivo</th><th>Estado</th>
            <td><?= $avaria->data ?></td><td><?= $dispositivo->referencia ?></td><td style="background-color: orange"></td>
        <?php
            }
        ?>
    </table>



</div>
