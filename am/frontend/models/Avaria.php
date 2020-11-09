<?php

namespace app\models;

use Yii;
use app\models\Dispositivo;

/**
 * This is the model class for table "avaria".
 *
 * @property int $idAvaria
 * @property string $descricao
 * @property int $tipo
 * @property int $estado
 * @property int $gravidade
 * @property string $data
 * @property int $idDispositivo
 * @property int|null $idRelatorio
 *
 * @property Dispositivo $idDispositivo0
 * @property Relatorio[] $relatorios
 */
class Avaria extends \yii\db\ActiveRecord
{
    public $referencia;
    public $count;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'avaria';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['descricao', 'tipo', 'gravidade', 'data'], 'required'],
            [['tipo', 'estado', 'gravidade', 'idDispositivo', 'idRelatorio'], 'integer'],
            [['data'], 'safe'],
            [['referencia'], 'safe'],
            [['descricao'], 'string', 'max' => 200],
            [['idDispositivo'], 'exist', 'skipOnError' => true, 'targetClass' => Dispositivo::className(), 'targetAttribute' => ['idDispositivo' => 'idDispositivo']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idAvaria' => 'Id Avaria',
            'descricao' => 'Descricao',
            'tipo' => 'Tipo',
            'estado' => 'Estado',
            'gravidade' => 'Gravidade',
            'data' => 'Data',
            'idDispositivo' => 'Id Dispositivo',
            'idRelatorio' => 'Id Relatorio',
        ];
    }

    /**
     * Gets query for [[IdDispositivo0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdDispositivo0()
    {
        return $this->hasOne(Dispositivo::className(), ['idDispositivo' => 'idDispositivo']);
    }

    /**
     * Gets query for [[Relatorios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRelatorios()
    {
        return $this->hasMany(Relatorio::className(), ['idAvaria' => 'idAvaria']);
    }

    public function getGravidade(){
        switch ($this->gravidade){
            case 0:
                $gravidade = "Nao funcional";
                break;
            case 1:
                $gravidade = "Funcional";
                break;
        }
        return $gravidade;
    }


    public function getEstado(){
        switch ($this->estado){
            case 0:
                return ['style' => 'background-color: red'];
                break;
            case 1:
                return ['style' => 'background-color: orange'];
                break;
            case 2:
                return ['style' => 'background-color: yellow'];
                break;
            case 3:
                return ['style' => 'background-color: green'];
                break;
        }
    }
}
