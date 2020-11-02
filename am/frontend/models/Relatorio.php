<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "relatorio".
 *
 * @property int $idRelatorio
 * @property int $idAvaria
 * @property int $idDispositivo
 * @property string|null $descricao
 *
 * @property Avaria $idAvaria0
 * @property Relatoriopecas[] $relatoriopecas
 */
class Relatorio extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'relatorio';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idAvaria', 'idDispositivo'], 'required'],
            [['idAvaria', 'idDispositivo'], 'integer'],
            [['descricao'], 'string', 'max' => 200],
            [['idAvaria'], 'exist', 'skipOnError' => true, 'targetClass' => Avaria::className(), 'targetAttribute' => ['idAvaria' => 'idAvaria']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idRelatorio' => 'Id Relatorio',
            'idAvaria' => 'Id Avaria',
            'idDispositivo' => 'Id Dispositivo',
            'descricao' => 'Descricao',
        ];
    }

    /**
     * Gets query for [[IdAvaria0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdAvaria0()
    {
        return $this->hasOne(Avaria::className(), ['idAvaria' => 'idAvaria']);
    }

    /**
     * Gets query for [[Relatoriopecas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRelatoriopecas()
    {
        return $this->hasMany(Relatoriopecas::className(), ['idRelatorio' => 'idRelatorio']);
    }
}
