<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\widgets\DetailView;
use yii\bootstrap\Dropdown;


/* @var $this yii\web\View */
/* @var $model app\models\Estatistica */
/* @var $form yii\widgets\ActiveForm */

$options = array('Anual', 'Mensal');
$mes = array('Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro');
?>
<div class="avaria-form">
    <div style="float: right">
        <?php $form = ActiveForm::begin();?>
        <?= $form->field($model, 'filtro')->dropDownList($options,['onchange' => 'this.form.submit()'])->label(false) ?>
        <?php
        if ($model->filtro == 1){
            echo $form->field($model, 'mes')->dropDownList($mes,['onchange' => 'this.form.submit()'])->label(false);
        }
        ?>
        <?php ActiveForm::end();?>
    </div>
    <?php
    echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'nAvaria',
                'label' => 'Numero de Avarias'
            ],
            [
                'attribute' => 'custoPeca',
                'label' => 'Custo de Peças (Total)'
            ],
            [
                'attribute' => 'nAvariaRes',
                'label' => 'Numero de Avarias Resolvidas'
            ],
            [
                'attribute' => 'nAvariaNr',
                'label' => 'Numero de Avarias Nao Resolvidas'
            ],
            [
                'attribute' => 'nDispositivoF',
                'label' => 'Numero de Dispositivos Funcionais'
            ],
            [
                'attribute' => 'nDispositivoNF',
                'label' => 'Numero de Dispositivos Nao Funcionais'
            ],
        ],
    ]);

    ?>

</div>