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
    public $filtro;
    public $mes;

    public function getnAvaria($mes){
        if($mes == null){
            $model = Avaria::find()->all();
            return count($model);
        }else{
            $model = Avaria::find()->where(['Month(data)' => $mes])->count();
            return $model;
        }
    }

    public function getcustoPeca($mes){

        return 1;
    }

    public function getnAvariaRes($mes){

        if($mes == null){
            $query = Avaria::find()->where(['estado' => 3])->count();
            return $query;
        }else{
            $query = Avaria::find()->where(['month(data)'=>$mes, 'estado' => 3])->count();
            return $query;
        }

    }

    public function getnAvariaNr($mes){

        if($mes == null){
            $query = Avaria::find()->where(['estado' => 1])->count();
            return $query;
        }else{
            $query = Avaria::find()->where(['month(data)'=>$mes, 'estado' => 1])->count();
            return $query;
        }

    }

    public function getnDispositivoF($mes){

        if($mes == null){
            $query = Dispositivo::find()->where(['estado' => 1])->count();
            return $query;
        }else{
            $query = Dispositivo::find()->where(['month(dataCompra)'=>$mes, 'estado' => 1])->count();
            return $query;
        }
    }

    public function getnDispositivoNF($mes){

        if($mes == null){
            $query = Dispositivo::find()->where(['estado' => 0])->count();
            return $query;
        }else{
            $query = Dispositivo::find()->where(['month(dataCompra)'=>$mes, 'estado' => 0])->count();
            return $query;
        }
    }

}