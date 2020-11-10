<?php


namespace frontend\controllers;


use app\models\Avaria;
use app\models\Estatistica;
use yii\web\Controller;
use yii;

class EstatisticaController extends Controller
{

    public function actionIndex(){
        $request = Yii::$app->request;
        $model = new Estatistica();
        if($model->load($request->post())){
            $model->filtro = $request->post('Estatistica');

            switch ($model->filtro['filtro']){
                case '':
                    $model->nAvaria = $model->getnAvaria();
                    $model->custoPeca = $model->getcustoPeca();
                    $model->nAvariaRes = $model->getnAvariaRes();
                    $model->nAvariaNr = $model->getnAvariaNr();
                    $model->nDispositivoF = $model->getnDispositivoF();
                    $model->nDispositivoNF = $model->getnDispositivoNF();
                    break;
                case '1':
                    break;
                case '2':
                    break;
            }
        }

        return $this->render('index', ['model' => $model]);
    }
}