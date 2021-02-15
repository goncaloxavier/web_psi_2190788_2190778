<?php namespace common\tests;

use common\models\Utilizador;

class UtilizadorTest extends \Codeception\Test\Unit
{
    /**
     * @var \common\tests\UnitTester
     */
    protected $tester;
    
    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function testValidation()
    {
        $user = new Utilizador();
        $this->validateUsername($user);
        $this->validatePassword($user);
        $this->validateEmail($user);
        $this->validateEstado($user);
        $this->validateTipo($user);
    }

    public function testSaveUser(){
        $user = new Utilizador();

        $user->setNomeUtilizador('granada');
        $user->setPalavraPasse('bmw451');
        $user->setEmail('tecnico@gmail.com');
        $user->setEstado(1);
        $user->setTipo(2);
        $user->setIdValidacao("22");
        $user->save();

        $this->tester->seeInDatabase('utilizador', [
                                                            'nomeUtilizador' => 'granada',
                                                            'palavraPasse' => 'bmw451',
                                                            'email' => 'tecnico@gmail.com',
                                                        ]);
    }

    public function validateUsername($user)
    {
        $user->setNomeUtilizador(null);
        $this->assertFalse($user->validate(['nomeUtilizador']));

        $user->setNomeUtilizador('toolooooongnaaaaaaameeee');
        $this->assertFalse($user->validate(['nomeUtilizador']));

        $user->setNomeUtilizador('davert');
        $this->assertTrue($user->validate(['nomeUtilizador']));
    }


    public function validatePassword($user)
    {
        $user->setPalavraPasse(null);
        $this->assertFalse($user->validate(['palavraPasse']));

        $user->setPalavraPasse('392901292801293809803931290');
        $this->assertFalse($user->validate(['palavraPasse']));

        $user->setPalavraPasse('23132');
        $this->assertTrue($user->validate(['palavraPasse']));
    }

    public function validateEmail($user)
    {
        $user->setEmail(null);
        $this->assertFalse($user->validate(['email']));

        $user->setEmail('mailcom');
        $this->assertFalse($user->validate(['email']));

        $user->setEmail('exemplo@gmail.com');
        $this->assertTrue($user->validate(['email']));
    }

    public function validateEstado($user)
    {
        $user->setEstado('a');
        $this->assertFalse($user->validate(['estado']));

        $user->setEstado(-1);
        $this->assertFalse($user->validate(['estado']));

        $user->setEstado(2);
        $this->assertFalse($user->validate(['estado']));

        $user->setEstado(1);
        $this->assertTrue($user->validate(['estado']));
    }

    public function validateTipo($user)
    {
        $user->setTipo('a');
        $this->assertFalse($user->validate(['tipo']));

        $user->setTipo(-1);
        $this->assertFalse($user->validate(['tipo']));

        $user->setTipo(3);
        $this->assertFalse($user->validate(['tipo']));

        $user->setTipo(2);
        $this->assertTrue($user->validate(['tipo']));
    }
}