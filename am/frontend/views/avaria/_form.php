<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Dispositivo;

/* @var $this yii\web\View */
/* @var $model app\models\Avaria */
/* @var $form yii\widgets\ActiveForm */
?>

<div align="center">
    <?php $form = ActiveForm::begin(); ?>
    <table style="width: 300px">
        <tr>
            <td align="left"><label>Tipo</label>
            <td><?= $form->field($model, 'tipo')->dropDownList($model->tipo_array, ['prompt' => 'Selecione tipo'])->label(false) ?>
        <tr>
            <td align="left"><label>Estado</label>
            <td> <?= $form->field($model, 'estado')->dropDownList($model->estado_array, ['prompt' => 'Selecione estado', 'disabled' => 'disabled'])->label(false) ?>
        <tr>
            <td align="left"><label>Gravidade</label>
            <td><?= $form->field($model, 'gravidade')->dropDownList($model->gravidade_array, ['prompt' => 'Selecione a gravidade'])->label(false) ?>
        <tr>
            <td align="left"><label>Data</label>
            <td> <?= $form->field($model, 'data')->textInput(['disabled' => 'disabled'])->label(false) ?>
        <tr>
            <td align="left"><label>Dispositivo</label>
            <td><?= $form->field($model, 'idDispositivo')->dropDownList(ArrayHelper::map(Dispositivo::find()->all(), 'idDispositivo', 'referencia'), ['prompt' => 'Selecione dispositivo'])->label(false) ?>
        <tr>
            <td align="left"><label>Descricao</label>
            <td> <?= $form->field($model, 'descricao')->textarea(['maxlength' => true])->label(false) ?>
        <tr>
            <td></td><td align="right"><?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </table>

    <?= $form->field($model, 'idRelatorio')->hiddenInput()->label(false) ?>

    <?php ActiveForm::end(); ?>
</div>
