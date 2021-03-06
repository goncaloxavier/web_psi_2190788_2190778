<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Utilizador */
/* @var $form yii\widgets\ActiveForm */
?>

<div align="center">
    <?php
        if($model->tipo == 2){
    ?>
        <?php $form = ActiveForm::begin(); ?>
        <table style="width: 300px">
            <tr>
                <td align="left"><label>Nome Utilizador</label>
                <td><?= $form->field($model, 'nomeUtilizador')->textInput(['maxlength' => true, 'disabled' => 'disabled'])->label(false)  ?>
            <tr>
                <td align="left"><label>Palavra Passe</label>
                <td> <?= $form->field($model, 'palavraPasse')->textInput(['maxlength' => true])->label(false) ?>
            <tr>
                <td align="left"><label>Email</label>
                <td> <?= $form->field($model, 'email')->textInput(['maxlength' => true])->label(false) ?>
            <tr>
                <td align="left"><label>Tipo</label>
                <td><?= $form->field($model, 'tipo')->dropDownList($model->tipo_array, ['prompt' => 'Admin', 'disabled' => 'disabled'])->label(false) ?>
            <tr>
                <td align="left"><label>Estado</label>
                <td> <?= $form->field($model, 'estado')->dropDownList($model->estado_array, ['prompt' => 'Ativo', 'disabled' => 'disabled'])->label(false) ?>
            <tr>
                <td></td><td align="right"><?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </table>
        <?php ActiveForm::end(); ?>
    <?php
        }
        else{
            $form = ActiveForm::begin();
    ?>
            <table style="width: 300px">
                <tr>
                    <td align="left"><label>Nome Utilizador</label>
                    <td><?= $form->field($model, 'nomeUtilizador')->textInput(['maxlength' => true,])->label(false)  ?>
                <tr>
                    <td align="left"><label>Palavra Passe</label>
                    <td> <?= $form->field($model, 'palavraPasse')->textInput(['maxlength' => true])->label(false) ?>
                <tr>
                    <td align="left"><label>Email</label>
                    <td> <?= $form->field($model, 'email')->textInput(['maxlength' => true])->label(false) ?>
                <tr>
                    <td align="left"><label>Tipo</label>
                    <td><?= $form->field($model, 'tipo')->dropDownList($model->tipo_array, ['prompt' => 'Selecione o tipo'])->label(false) ?>
                <tr>
                    <td align="left"><label>Estado</label>
                    <td> <?= $form->field($model, 'estado')->dropDownList($model->estado_array, ['prompt' => 'Selecione o estado'])->label(false) ?>
                <tr>
                    <td></td><td align="right"><?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </table>
    <?php
            ActiveForm::end();
        }
    ?>
</div>