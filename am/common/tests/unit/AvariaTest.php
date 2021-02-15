<?php namespace common\tests;

use common\models\Avaria;
use common\models\Dispositivo;
use common\models\Relatorio;
use common\models\Relatoriopeca;
use common\models\Utilizador;

class AvariaTest extends \Codeception\Test\Unit
{
    /**
     * @var \common\tests\UnitTester
     */
    protected $tester;

    protected function _before()
    {
        $this->deleteAll();

        $d = $this->getDispositivoValido();
        $d->save();

        $user = $this->getUtilizadorValido();
        $user->save();
    }

    public function getAvariaValida(){
        $a = new Avaria();
        $d = $this->getDispositivoValido();
        $u = $this->getUtilizadorValido();

        $a->estado = 3;
        $a->gravidade = 1;
        $a->idDispositivo = $d->idDispositivo;
        $a->data = date("Y-m-d H:i:s");
        $a->descricao = "Testing";
        $a->tipo = 1;
        $a->idUtilizador = $u->idUtilizador;

        return $a;
    }

    public function testSaveAvaria(){
        $a = $this->getAvariaValida();
        $a->save();

        $this->tester->seeInDatabase('avaria', ['descricao' => 'Testing', 'tipo' => 1]);
    }

    public function testAvariaValidation(){
        $a = $this->getAvariaValida();
        $this->tester->assertFalse($a->estado > 3);
    }

    public function getUtilizadorValido(){
        $user = new Utilizador();

        $user->setIdUtilizador(1);
        $user->setNomeUtilizador('granada');
        $user->setPalavraPasse('bmw451');
        $user->setEmail('tecnico@gmail.com');
        $user->setIdValidacao("22");
        $user->setEstado(1);
        $user->setTipo(2);

        return $user;
    }

    public function getDispositivoValido(){
        $d = new Dispositivo();

        $d->idDispositivo = 1;
        $d->referencia = "PC-01";
        $d->estado = 1;
        $d->dataCompra = "2015/04/22";
        $d->tipo = "PC";

        return $d;
    }

    public function deleteAll(){
        Relatoriopeca::deleteAll();
        Relatorio::deleteAll();
        Avaria::deleteAll();
        Dispositivo::deleteAll();
        Utilizador::deleteAll();
    }

}