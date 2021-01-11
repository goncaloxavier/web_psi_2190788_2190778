<?php


namespace frontend\controllers;


use app\models\Avaria;
use app\models\Estatistica;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii;

class EstatisticaController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'view', 'update', 'create', 'delete'],
                        'allow' => false,
                        'roles' => ['funcionario'],
                    ],
                    [
                        'actions' => ['index', 'view', 'update','create', 'delete'],
                        'allow' => true,
                        'roles' => ['tecnico'],
                    ],
                    [
                        'actions' => ['index', 'view', 'update','create', 'delete'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex(){
        $request = Yii::$app->request;
        $model = new Estatistica();
        if($model->load($request->post())){
            $option = $request->post('Estatistica');
            $model->filtro = $option['filtro'];
            switch ($model->filtro){
                case '0':
                    $model->nAvaria = $model->getnAvaria(null);
                    $model->custoPeca = $model->getTotalPecas(null).'€';
                    $model->nAvariaRes = $model->getnAvariaRes(null);
                    $model->nAvariaNr = $model->getnAvariaNr(null);
                    $model->nDispositivoF = $model->getnDispositivoF(null);
                    $model->nDispositivoNF = $model->getnDispositivoNF(null);
                    break;
                case '1':
                    if(isset($option['mes'])){
                        $model->mes = $option['mes'];
                        $model->nAvaria = $model->getnAvaria(($model->mes+1));
                        $model->custoPeca = $model->getTotalPecas(($model->mes+1)).'€';
                        $model->nAvariaRes = $model->getnAvariaRes(($model->mes+1));
                        $model->nAvariaNr = $model->getnAvariaNr(($model->mes+1));
                        $model->nDispositivoF = $model->getnDispositivoF(($model->mes+1));
                        $model->nDispositivoNF = $model->getnDispositivoNF(($model->mes+1));
                    }else{
                        $model->mes = 0;
                        $model->nAvaria = $model->getnAvaria(($model->mes+1));
                        $model->custoPeca = $model->getTotalPecas(($model->mes+1)).'€';
                        $model->nAvariaRes = $model->getnAvariaRes(($model->mes+1));
                        $model->nAvariaNr = $model->getnAvariaNr(($model->mes+1));
                        $model->nDispositivoF = $model->getnDispositivoF(($model->mes+1));
                        $model->nDispositivoNF = $model->getnDispositivoNF(($model->mes+1));
                    }
                    break;
            }
        }else{
            $model->nAvaria = $model->getnAvaria(null);
            $model->custoPeca = $model->getTotalPecas(null).'€';
            $model->nAvariaRes = $model->getnAvariaRes(null);
            $model->nAvariaNr = $model->getnAvariaNr(null);
            $model->nDispositivoF = $model->getnDispositivoF(null);
            $model->nDispositivoNF = $model->getnDispositivoNF(null);
        }

        return $this->render('index', ['model' => $model]);
    }
}