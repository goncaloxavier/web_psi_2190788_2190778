<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Avaria */

$this->title = 'Create Avaria';
$this->params['breadcrumbs'][] = ['label' => 'Avarias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="avaria-create">
    <h2><?= Html::encode($this->title) ?></h2>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
