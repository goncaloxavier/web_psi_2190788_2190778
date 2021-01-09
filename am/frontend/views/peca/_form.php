<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Peca */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="center-screen">
    <?php $form = ActiveForm::begin(); ?>
    <table style="width: 300px">
        <tr>
            <td align="left"><label>Descricao</label>
            <td>  <?= $form->field($model, 'descricao')->textInput()->label(false) ?>
        <tr>
            <td align="left"><label>Custo</label>
            <td><?= $form->field($model, 'custo')->textInput()->label(false)?>
        <tr>
            <td></td><td align="right"><?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </table>
    <?php ActiveForm::end(); ?>
</div>