<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Utilizador */

$this->title = 'Create Utilizador';
$this->params['breadcrumbs'][] = ['label' => 'Utilizadores', 'url' => ['index?estado=1']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="utilizador-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
