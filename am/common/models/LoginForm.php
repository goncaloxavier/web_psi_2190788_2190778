<?php
namespace common\models;

use common\models\Utilizador;
use Yii;
use yii\base\Model;
use yii\web\ForbiddenHttpException;

/**
 * Login form
 */
class LoginForm extends Model
{
    public $nomeUtilizador;
    public $palavraPasse;
    public $rememberMe = true;

    private $_user;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['nomeUtilizador', 'palavraPasse'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['palavraPasse', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $utilizador = $this->getUser();
            if (!$utilizador || !$utilizador->validatePassword($this->palavraPasse)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        $user = $this->getUser();
        if ($this->validate() && $user->estado == 1) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        }
        
        return false;
    }

    /**
     * Finds user by [[nomeUtilizador]]
     *
     * @return Utilizador|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = Utilizador::findByUsername($this->nomeUtilizador);
        }

        return $this->_user;
    }
}
