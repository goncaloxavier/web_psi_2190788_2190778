<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Dispositivo;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Avaria */
/* @var $form yii\widgets\ActiveForm */

$estado = array('Starvation', 'Nao Resolvido', 'Em Resolucao', 'Resolvido');
?>

<div class="avaria-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'descricao')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tipo')->textInput() ?>

    <?= $form->field($model, 'estado')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'estado')->dropDownList($estado,
        ['prompt' => 'Selecione dispositivo']
    )->label('estado') ?>

    <?= $form->field($model, 'gravidade')->textInput() ?>

    <?= $form->field($model, 'data')->textInput() ?>

    <?= $form->field($model, 'idDispositivo')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'idDispositivo')->dropDownList(ArrayHelper::map(Dispositivo::find()->all(), 'idDispositivo', 'referencia'),
        ['prompt' => 'Selecione dispositivo']
    )->label('Dispositivo') ?>

    <?= $form->field($model, 'idRelatorio')->hiddenInput()->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
