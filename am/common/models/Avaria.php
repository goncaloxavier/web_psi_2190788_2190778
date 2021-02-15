<?php

namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;


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
 * @property int $idUtilizador
 *
 * @property Dispositivo $idDispositivo0
 * @property Relatorio[] $relatorios
 */
class Avaria extends \yii\db\ActiveRecord
{
    public $referencia;
    public $count;
    public $estado_array = array('Starvation', 'Nao Resolvido', 'Em Resolucao', 'Resolvido');
    public $tipo_array = array('Hardware','Software');
    public $gravidade_array = array('Não Funcional','Funcional');
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
            [['descricao', 'tipo', 'gravidade', 'data', 'idDispositivo', 'estado'], 'required'],
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

    public function getTipo(){
        switch ($this->tipo){
            case 0:
                $tipo = "Hardware";
                break;
            case 1:
                $tipo = "Software";
                break;
        }
        return $tipo;
    }

    public function getEstado(){
        switch ($this->estado){
            case 0:
                return ['style' => 'background-color: red'];
            case 1:
                return ['style' => 'background-color: orange'];
            case 2:
                return ['style' => 'background-color: yellow'];
            case 3:
                return ['style' => 'background-color: green'];
        }
    }

    /**
     * @return int
     */
    public function getIdAvaria()
    {
        return $this->idAvaria;
    }

    /**
     * @param int $idAvaria
     */
    public function setIdAvaria($idAvaria)
    {
        $this->idAvaria = $idAvaria;
    }

    /**
     * @return string
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * @param string $descricao
     */
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }

    /**
     * @return string
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param string $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     * @return int
     */
    public function getIdDispositivo()
    {
        return $this->idDispositivo;
    }

    /**
     * @param int $idDispositivo
     */
    public function setIdDispositivo($idDispositivo)
    {
        $this->idDispositivo = $idDispositivo;
    }

    /**
     * @return int|null
     */
    public function getIdRelatorio()
    {
        return $this->idRelatorio;
    }

    /**
     * @param int|null $idRelatorio
     */
    public function setIdRelatorio($idRelatorio)
    {
        $this->idRelatorio = $idRelatorio;
    }

    /**
     * @return int
     */
    public function getIdUtilizador()
    {
        return $this->idUtilizador;
    }

    /**
     * @param int $idUtilizador
     */
    public function setIdUtilizador($idUtilizador)
    {
        $this->idUtilizador = $idUtilizador;
    }
}
