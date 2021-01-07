<?php

namespace common\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "utilizador".
 *
 * @property int $idUtilizador
 * @property string $nomeUtilizador
 * @property string $palavraPasse
 * @property string $email
 * @property int $tipo
 * @property int $estado
 * @property string $idValidacao
 */
class Utilizador extends \yii\db\ActiveRecord implements IdentityInterface
{
    public $tipo_array = array('Funcionario', 'Tecnico');
    public $estado_array = array('Inativo', 'Ativo');

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
            [['nomeUtilizador', 'email', 'tipo', 'palavraPasse'], 'required'],
            [['estado'], 'integer', 'min' => 0, 'max' => 1],
            [['tipo'], 'integer', 'min' => 0, 'max' => 2],
            [['nomeUtilizador'], 'string', 'max' => 20],
            [['palavraPasse'], 'string', 'max' => 18],
            ['Email', 'filter', 'filter' => 'trim'],
            [['email'], 'email'],
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
            'nomeUtilizador' => 'Nome Utilizador',
            'palavraPasse' => 'Palavra Passe',
            'email' => 'Email',
            'tipo' => 'Tipo',
            'estado' => 'Estado',
            'idValidacao' => 'Id Validacao',
        ];
    }

    public function setPassword($password){
        $this->palavraPasse = $password;
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

    /**
     * @param int $idUtilizador
     */
    public function setIdUtilizador($idUtilizador)
    {
        $this->idUtilizador = $idUtilizador;
    }

    /**
     * @param string $nomeUtilizador
     */
    public function setNomeUtilizador($nomeUtilizador)
    {
        $this->nomeUtilizador = $nomeUtilizador;
    }

    /**
     * @param string $palavraPasse
     */
    public function setPalavraPasse($palavraPasse)
    {
        $this->palavraPasse = $palavraPasse;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @param string $tipo
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }

    /**
     * @param int $estado
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;
    }

    /**
     * @param string $idValidacao
     */
    public function setIdValidacao($idValidacao)
    {
        $this->idValidacao = $idValidacao;
    }

    /**
     * @param string[] $tipo_array
     */
    public function setTipoArray($tipo_array)
    {
        $this->tipo_array = $tipo_array;
    }

    /**
     * @param string[] $estado_array
     */
    public function setEstadoArray($estado_array)
    {
        $this->estado_array = $estado_array;
    }

    /**
     * @return int
     */
    public function getIdUtilizador()
    {
        return $this->idUtilizador;
    }

    /**
     * @return string
     */
    public function getNomeUtilizador()
    {
        return $this->nomeUtilizador;
    }

    /**
     * @return string
     */
    public function getPalavraPasse()
    {
        return $this->palavraPasse;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * @return int
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * @return string
     */
    public function getIdValidacao()
    {
        return $this->idValidacao;
    }

    /**
     * @return string[]
     */
    public function getTipoArray()
    {
        return $this->tipo_array;
    }

    /**
     * @return string[]
     */
    public function getEstadoArray()
    {
        return $this->estado_array;
    }

    public function setRole($tipo, $idUtilizador){
        $auth = \Yii::$app->authManager;
        switch ($tipo){
            case 0:
                $funcionarioRole = $auth->getRole('funcionario');
                $auth->revokeAll($idUtilizador);
                $auth->assign($funcionarioRole, $idUtilizador);
                break;
            case 1:
                $tecnicoRole = $auth->getRole('tecnico');
                $auth->revokeAll($idUtilizador);
                $auth->assign($tecnicoRole, $idUtilizador);
                break;
        }
    }
}
