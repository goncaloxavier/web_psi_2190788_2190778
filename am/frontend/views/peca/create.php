<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Peca */

$this->title = 'Create Peca';
$this->params['breadcrumbs'][] = ['label' => 'Pecas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h2><?= Html::encode($this->title) ?></h2>
<div class="peca-create" align="center">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
