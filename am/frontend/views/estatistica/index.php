<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Estatistica */

$this->title = 'Estatistica';
$this->params['breadcrumbs'][] = ['label' => 'Estatistica', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="avaria-create">

    <h2><?= Html::encode($this->title) ?></h2>

    <?= $this->render('_form', ['model' => $model])?>

</div>
