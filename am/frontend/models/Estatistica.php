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
        $query = 0;

        if($mes == null){
            $query = Dispositivo::find()->where(['estado' => 1])->count();
            return $query;
        }else{
            $dispositivos = Dispositivo::find()->all();
             foreach ($dispositivos as $dispositivo){
                if(sizeof($dispositivo->avarias) != 0){
                    $validateNF = "SELECT * FROM AVARIA WHERE idDispositivo = ".$dispositivo->idDispositivo." and ((estado = 0 or estado = 1) and gravidade = 0)";
                    foreach ($dispositivo->avarias as $avaria){
                       $month = date("m",strtotime($avaria->data));
                       $count = Avaria::findBySql($validateNF)->count();
                       if((int)$month == $mes && ($count == 0 && ($avaria->estado == 2 || $avaria->gravidade == 1))){
                            $query ++;
                       }
                    }
                }
             }
        }

        return $query;
    }

    public function getnDispositivoNF($mes){
        $query = 0;

        if($mes == null){
            $query = Dispositivo::find()->where(['estado' => 0])->count();
            return $query;
        }else{
            $query = Avaria::find()
                        ->where('month(data) = '.$mes.' and (gravidade = 0 and (estado = 0 or estado = 1))')
                        ->count('DISTINCT(idDispositivo)');
        }
        return $query;
    }

    public function getTotalPecas($mes){
        $total = 0;
        if($mes == null){
            $model = Peca::find()->all();
            foreach ($model as $peca){
                if(sizeof($peca->relatoriopecas) != 0){
                    $total += $peca->custo;
                }
            }

            return $total;
        }else{
            $modelAvaria = Avaria::find()->where(['month(data)'=>$mes])->all();
            $model = Peca::find()->all();

            foreach ($modelAvaria as $avaria){
                if($avaria->idRelatorio != null){
                    foreach ($model as $peca){
                        for($i = 0; $i < sizeof($peca->relatoriopecas); $i++){
                            if($peca->relatoriopecas[$i]->idRelatorio == $avaria->idRelatorio){
                                $total += $peca->custo;
                            }
                        }
                    }
                }
            }

            return $total;
        }
    }

}