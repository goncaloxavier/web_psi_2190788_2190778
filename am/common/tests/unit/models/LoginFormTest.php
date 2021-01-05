<?php

namespace common\tests\unit\models;

use Yii;
use common\models\LoginForm;
use common\fixtures\UserFixture;

/**
 * Login form test
 */
class LoginFormTest extends \Codeception\Test\Unit
{
    /**
     * @var \common\tests\UnitTester
     */
    protected $tester;


    /**
     * @return array
     */
    public function _fixtures()
    {
        return [
            'user' => [
                'class' => UserFixture::className(),
                'dataFile' => codecept_data_dir() . 'user.php'
            ]
        ];
    }

    public function testLoginNoUser()
    {
        $model = new LoginForm([
            'nomeUtilizador' => 'not_existing_user',
            'palavraPasse' => 'not_existing_password',
        ]);

        expect('model should not login user', $model->login())->false();
        expect('user should not be logged in', Yii::$app->user->isGuest)->true();
    }

    public function testLoginWrongPassword()
    {
        $model = new LoginForm([
            'nomeUtilizador' => 'bayer.hudson',
            'palavraPasse' => 'wrong_password',
        ]);

        expect('model should not login user', $model->login())->false();
        expect('error message should be set', $model->errors)->hasKey('palavraPasse');
        expect('user should not be logged in', Yii::$app->user->isGuest)->true();
    }

    public function testLoginCorrect()
    {
        $model = new LoginForm([
            'nomeUtilizador' => 'admin',
            'palavraPasse' => 'adminam1',
        ]);

        expect('model should login user', $model->login())->true();
        expect('error message should not be set', $model->errors)->hasntKey('palavraPasse');
        expect('user should be logged in', Yii::$app->user->isGuest)->false();
    }
}
