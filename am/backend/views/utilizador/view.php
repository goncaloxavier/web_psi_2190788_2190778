<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Utilizador */

$this->title = $model->idUtilizador;
$this->params['breadcrumbs'][] = ['label' => 'Utilizadores', 'url' => ['index', 'estado' => 1]];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="utilizador-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->idUtilizador], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->idUtilizador], [
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
            'idUtilizador',
            'nomeUtilizador',
            'palavraPasse',
            'email:email',
            [
                'attribute' => 'tipo',
                'label' => 'Tipo',
                'value' => function($model){
                    return $model->getRole();
                },
            ],
            [
                'attribute' => 'estado',
                'label' => 'Estado',
                'value' => function($model){
                    switch ($model->estado){
                        case 0:
                            return 'Inativo';
                        case 1:
                            return 'Ativo';
                    }
                },
            ],
        ],
    ]) ?>

</div>
