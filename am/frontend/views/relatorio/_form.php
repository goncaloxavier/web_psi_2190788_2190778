<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Dispositivo;
use app\models\Relatoriopeca;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Relatorio */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="relatorio-form">

    <?php $form = ActiveForm::begin(); ?>
    <table align="center" style="width: 300px">
        <td><label>ID Avaria</label></td>
            <td><?= $form->field($model, 'idAvaria')->textInput(['disabled' => 'disabled'])->label(false) ?></td>
        <tr>
            <td><label>Autor<label></td>
            <td><?= $form->field($model, 'autor')->textInput(['disabled' => 'disabled'])->label(false) ?></td>
        <tr>
            <td><label>Descricao da Avaria<label></td>
            <td><?= $form->field($model, 'descricaoA')->textarea(['disabled' => 'disabled'])->label(false) ?></td>
        <tr>
            <td align="left"><label>Dispositivo</label>
            <td><?= $form->field($model, 'idDispositivo')->dropDownList(ArrayHelper::map(Dispositivo::find()->all(), 'idDispositivo', 'referencia'), ['prompt' => 'Selecione dispositivo', 'disabled' => 'disabled'])->label(false) ?>
        <tr>
            <td><label>Notas</label>
            <td><?= $form->field($model, 'descricao')->textarea(['maxlength' => true])->label(false) ?>
        <tr>
            <td><label>Pecas</label>
            <td><?=Select2::widget([
                    'model' => $model,
                    'name' => 'Pecas',
                    'attribute' => 'listPecas',
                    'data' => $model->getPecas(),
                    'options' => [
                        'placeholder' => 'Selecione as peças...',
                        'multiple' => true
                    ],
                    'pluginOptions' => [
                        'tags' => true,
                        'maximumInputLength' => 10
                    ],
                ]);  ?>
        <tr>
                <td></td><td align="right"><?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </table>

    <?php ActiveForm::end(); ?>
</div>
