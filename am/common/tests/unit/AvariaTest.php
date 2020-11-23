<?php namespace common\tests;

use app\models\Avaria;
use app\models\Dispositivo;

class AvariaTest extends \Codeception\Test\Unit
{
    /**
     * @var \common\tests\UnitTester
     */
    protected $tester;

    protected function _before()
    {

    }

    public function getAvariaValida(){
        $a = new Avaria();

        $a->estado = 3;
        $a->gravidade = 1;
        $a->idDispositivo = 1;
        $a->data = date("Y-m-d H:i:s");
        $a->descricao = "Testing";
        $a->tipo = 1;

        return $a;
    }

    public function testAvariaValida(){
        $d = $this->getDispositivoValido();
        $d->save();
        $a = $this->getDispositivoValido();
        $a->save();
    }

    public function getDispositivoValido(){
        $d = new Dispositivo();

        $d->referencia = "PC-01";
        $d->estado = 1;
        $d->dataCompra = "2015/04/22";
        $d->tipo = "PC";

        return $d;
    }
}