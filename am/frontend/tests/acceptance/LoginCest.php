<?php
namespace frontend\tests\acceptance;

use frontend\tests\AcceptanceTester;

class LoginCest
{
    public function LoginUser(AcceptanceTester $I)
    {
        $I->amOnPage('site/login');
        $I->fillField('Nome Utilizador', 'tecnico');
        $I->fillField('Palavra Passe', 'tecnicoam1');
        $I->click('Login');
    }
}
