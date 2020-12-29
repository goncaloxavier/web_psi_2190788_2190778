<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Dispositivo */

$this->title = 'Create Dispositivo';
$this->params['breadcrumbs'][] = ['label' => 'Dispositivos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h2 align="left"><?= Html::encode($this->title) ?></h2>
<div class="dispositivo-create" align="center">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
