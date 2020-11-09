<?php


namespace app\models;
use app\models\Avaria;
use app\models\Dispositivo;
use app\models\Peca;


class Estatistica extends \yii\db\ActiveRecord
{
    public $nAvaria;
    public $custoPeca;
    public $nAvariaRes;
    public $nAvariaNr;
    public $nDispositivoF;
    public $nDispositivoNF;

    public function getnAvaria(){
        $model = Avaria::find()->all();

        return count($model);;
    }

    public function getcustoPeca(){

        return 1;
    }

    public function getnAvariaRes(){
        $query = Avaria::find()->where(['estado' => 3])->count();

        return $query;
    }

    public function getnAvariaNr(){
        $query = Avaria::find()->where(['estado' => 1])->count();

        return $query;
    }

    public function getnDispositivoF(){
        $query = Dispositivo::find()->where(['estado' => 1])->count();

        return $query;
    }

    public function getnDispositivoNF(){
        $query = Dispositivo::find()->where(['estado' => 0])->count();

        return $query;
    }
}