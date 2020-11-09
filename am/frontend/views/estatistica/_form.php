<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Estatistica */
/* @var $form yii\widgets\ActiveForm */

$model->nAvaria = $model->getnAvaria();
$model->custoPeca = $model->getcustoPeca();
$model->nAvariaRes = $model->getnAvariaRes();
$model->nAvariaNr = $model->getnAvariaNr();
$model->nDispositivoF = $model->getnDispositivoF();
$model->nDispositivoNF = $model->getnDispositivoNF();
?>

<div class="avaria-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nAvaria') ?>
    <?= $form->field($model, 'custoPeca') ?>
    <?= $form->field($model, 'nAvariaRes') ?>
    <?= $form->field($model, 'nAvariaNr') ?>
    <?= $form->field($model, 'nDispositivoF') ?>
    <?= $form->field($model, 'nDispositivoNF') ?>

    <?php ActiveForm::end(); ?>

</div>
