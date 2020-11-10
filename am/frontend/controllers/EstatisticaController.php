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
            $option = $request->post('Estatistica');
            $model->filtro = $option['filtro'];
            switch ($model->filtro){
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
        }else{
            $model->nAvaria = $model->getnAvaria();
            $model->custoPeca = $model->getcustoPeca();
            $model->nAvariaRes = $model->getnAvariaRes();
            $model->nAvariaNr = $model->getnAvariaNr();
            $model->nDispositivoF = $model->getnDispositivoF();
            $model->nDispositivoNF = $model->getnDispositivoNF();
        }

        return $this->render('index', ['model' => $model]);
    }
}