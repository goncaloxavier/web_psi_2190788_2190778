<?php

namespace frontend\tests\functional;

use frontend\tests\FunctionalTester;

class HomeCest
{
    public function checkOpen(FunctionalTester $I)
    {
        $I->amOnPage(\Yii::$app->homeUrl);
        $I->see('Anomaly Managment');
        $I->seeLink('Login');
        $I->click('Login');
        $I->see('Please fill out the following fields to login:');
    }
}