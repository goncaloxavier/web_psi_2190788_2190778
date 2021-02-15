<?php namespace common\tests\unit;
use common\models\Avaria;
use common\models\Dispositivo;
use common\models\Peca;
use common\models\Relatorio;
use common\models\Relatoriopeca;
use common\models\Utilizador;
use common\tests\UnitTester;

class RelatorioTest extends \Codeception\Test\Unit
{
    /**
     * @var \common\tests\UnitTester
     */
    protected $tester;

    public function _before()
    {
        Relatoriopeca::deleteAll();
        Relatorio::deleteAll();
        Peca::deleteAll();
        Avaria::deleteAll();
        Dispositivo::deleteAll();
        Utilizador::deleteAll();

        $this->saveRecords();
    }

    // tests
    public function testSeeInDatabase()
    {
        $this->tester->seeInDatabase('relatorio', ['descricao' => 'testing']);
    }

    public function getAvariaValida($funcionario, $dispositivo){
        $a = new Avaria();

        $a->estado = 3;
        $a->gravidade = 1;
        $a->idDispositivo = $dispositivo->idDispositivo;
        $a->data = date("Y-m-d H:i:s");
        $a->descricao = "Testing";
        $a->tipo = 1;
        $a->idUtilizador = $funcionario->idUtilizador;

        return $a;
    }

    public function getFuncionarioValido(){
        $user = new Utilizador();

        $user->setNomeUtilizador('granada');
        $user->setPalavraPasse('bmw451');
        $user->setEmail('granada@gmail.com');
        $user->setIdValidacao("22");
        $user->setEstado(1);
        $user->setTipo(0);

        return $user;
    }

    public function getTecnicoValido(){
        $user = new Utilizador();

        $user->setNomeUtilizador('tecnico');
        $user->setPalavraPasse('tecnicotest');
        $user->setEmail('tecnico@gmail.com');
        $user->setIdValidacao("22");
        $user->setEstado(1);
        $user->setTipo(1);

        return $user;
    }

    public function getDispositivoValido(){
        $d = new Dispositivo();

        $d->referencia = "PC-01";
        $d->estado = 1;
        $d->dataCompra = "2015/04/22";
        $d->tipo = "PC";

        return $d;
    }

    public function getPecaValida(){
        $p = new Peca();
        $p->custo = 150;
        $p->descricao = "MotherBoard";

        return $p;
    }

    public function getRelatorioValido($tecnico, $avaria){
        $r = new Relatorio();
        $r->idAvaria = $avaria->idAvaria;
        $r->idDispositivo = $avaria->idDispositivo;
        $r->idUtilizador = $tecnico->idUtilizador;
        $r->descricao = 'testing';

        return $r;
    }

    public function getRelatorioPecaValido($relatorio, $peca){
        $relatorioPeca = new Relatoriopeca();
        $relatorioPeca->idRelatorio = $relatorio->idRelatorio;
        $relatorioPeca->idPeca = $peca->idPeca;

        return $relatorioPeca;
    }

    public function saveRecords(){
        $t = $this->getTecnicoValido();
        $t->save();

        $f = $this->getFuncionarioValido();
        $f->save();

        $d = $this->getDispositivoValido();
        $d->save();

        $a = $this->getAvariaValida($f, $d);
        $a->save();

        $p = $this->getPecaValida();
        $p->save();

        $r = $this->getRelatorioValido($t, $a);
        $r->save();

        $relatorioPeca = $this->getRelatorioPecaValido($r, $p);
        $relatorioPeca->save();
    }
}
