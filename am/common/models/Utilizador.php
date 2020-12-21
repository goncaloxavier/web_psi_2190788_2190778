<?php

namespace common\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "utilizador".
 *
 * @property int $idUtilizador
 * @property string $nome
 * @property string $nomeUtilizador
 * @property string $palavraPasse
 * @property string $email
 * @property int $estado
 * @property string $idValidacao
 */
class Utilizador extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'utilizador';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome', 'nomeUtilizador', 'palavraPasse', 'email'], 'required'],
            [['estado'], 'integer'],
            [['nome'], 'string', 'max' => 100],
            [['nomeUtilizador'], 'string', 'max' => 20],
            [['palavraPasse'], 'string', 'max' => 18],
            [['email'], 'string', 'max' => 50],
            [['idValidacao'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idUtilizador' => 'Id Utilizador',
            'nome' => 'Nome',
            'nomeUtilizador' => 'Nome Utilizador',
            'palavraPasse' => 'Palavra Passe',
            'email' => 'Email',
            'estado' => 'Estado',
            'idValidacao' => 'Id Validacao',
        ];
    }

    public static function findIdentity($id)
    {
        return self::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        // TODO: Implement findIdentityByAccessToken() method.
    }

    public function getId()
    {
       return $this->idUtilizador;
    }

    public function getAuthKey()
    {
        return $this->idValidacao;
    }

    public function validateAuthKey($authKey)
    {
        return $this->idValidacao === $authKey;
    }

    public static function findByUsername($nomeUtilizador){
        return self::findOne(['nomeUtilizador' => $nomeUtilizador]);
    }

    public function validatePassword($password){
        return $this->palavraPasse === $password;
    }
}
