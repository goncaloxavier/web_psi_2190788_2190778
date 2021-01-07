<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "dispositivo".
 *
 * @property int $idDispositivo
 * @property int $estado
 * @property string $dataCompra
 * @property string $tipo
 * @property string $referencia
 *
 * @property Avaria[] $avarias
 */
class Dispositivo extends \yii\db\ActiveRecord
{
    public $estado_array = array('Nao Funcional', 'Funcional');
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dispositivo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['estado'], 'integer'],
            [['dataCompra', 'tipo', 'referencia'], 'required'],
            [['dataCompra'], 'safe'],
            [['tipo'], 'string', 'max' => 30],
            [['referencia'], 'string', 'max' => 70],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idDispositivo' => 'Id Dispositivo',
            'estado' => 'Estado',
            'dataCompra' => 'Data Compra',
            'tipo' => 'Tipo',
            'referencia' => 'Referencia',
        ];
    }

    /**
     * Gets query for [[Avarias]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAvarias()
    {
        return $this->hasMany(Avaria::className(), ['idDispositivo' => 'idDispositivo']);
    }

    public function getEstado(){
        switch ($this->estado){
            case 0:
                return ['style' => 'background-color: orange'];
            case 1:
                return ['style' => 'background-color: green'];
        }
    }
}
