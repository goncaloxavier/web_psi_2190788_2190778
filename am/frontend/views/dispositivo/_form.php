<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Dispositivo */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="center-screen">

    <?php $form = ActiveForm::begin(); ?>


    <table>
        <tr>
            <td align="left"><label>Data Compra</label>
            <td>  <?= $form->field($model, 'dataCompra')->textInput()->label(false) ?>
        <tr>
            <td align="left"><label>Tipo</label>
            <td><?= $form->field($model, 'tipo')->textInput()->label(false)?>
        <tr>
            <td align="left"><label>Referência</label>
            <td><?= $form->field($model, 'referencia')->textInput(['maxlength' => true])->label(false) ?>
        <tr>
            <td align="left"><label>Estado</label>
            <td><?= $form->field($model, 'estado')->dropDownList($model->estado_array, ['prompt' => 'Selecione estado'])->label(false) ?>
        <tr>
            <td align="left"><label>Estado</label>
            <td><?= $form->field($model, 'estado')->dropDownList($model->estado_array, ['prompt' => 'Selecione estado']
                )->label(false) ?>
        <tr>
            <td></td><td align="right"><?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </table>

    <?php ActiveForm::end(); ?>

</div>
