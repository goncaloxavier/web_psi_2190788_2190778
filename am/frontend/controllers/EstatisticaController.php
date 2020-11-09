<?php


namespace frontend\controllers;


use app\models\Avaria;
use app\models\Estatistica;
use yii\web\Controller;

class EstatisticaController extends Controller
{

    public function actionIndex(){
        $model = new Estatistica();

        return $this->render('index', ['model' => $model]);
    }
}