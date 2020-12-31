<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $model app\models\Relatorio */

$this->title = $model->idRelatorio;
$this->params['breadcrumbs'][] = ['label' => 'Relatorios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="relatorio-view">
    <p>
        <?= Html::a('Avaria', ['avaria/view', 'id' => $model->idAvaria], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Update', ['update', 'id' => $model->idRelatorio], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->idRelatorio], [
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
        ],
    ]) ?>
    <table style="font-family: arial, sans-serif; border-collapse: collapse;">
        <?php
        echo '<th style=" border: 1px solid #dddddd; text-align: left; padding: 8px; width: 50%;" rowspan='.$model->getSizePlus1().'>Pecas';
        echo '<tr>';
          foreach($model->relatoriopecas as $relatoriopeca){
              echo '<td style=" border: 1px solid #dddddd; text-align: left; padding: 8px;">'.$relatoriopeca->idPeca0->descricao." ".$relatoriopeca->idPeca0->custo."€";
              echo '<tr>';
          }
        ?>
    </table>

</div>
