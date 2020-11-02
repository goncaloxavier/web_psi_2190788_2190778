<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "utilizador".
 *
 * @property int $idUtilizador
 * @property string $username
 * @property string $password
 * @property int $tipo
 */
class Utilizador extends \yii\db\ActiveRecord
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
            [['username', 'password', 'tipo'], 'required'],
            [['tipo'], 'integer'],
            [['username'], 'string', 'max' => 100],
            [['password'], 'string', 'max' => 18],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idUtilizador' => 'Id Utilizador',
            'username' => 'Username',
            'password' => 'Password',
            'tipo' => 'Tipo',
        ];
    }
}
