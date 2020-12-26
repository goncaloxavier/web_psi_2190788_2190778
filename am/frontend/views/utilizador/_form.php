<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Utilizador */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="utilizador-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nomeUtilizador')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'palavraPasse')->textInput(['maxlength' => true])->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tipo')->dropDownList($model->tipo_array, ['prompt' => 'Selecione o tipo']) ?>

    <?= $form->field($model, 'estado')->textInput()->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'idValidacao')->textInput(['maxlength' => true])->hiddenInput()->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
