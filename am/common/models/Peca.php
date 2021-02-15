<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "peca".
 *
 * @property int $idPeca
 * @property string $descricao
 * @property float $custo
 *
 * @property Relatoriopeca[] $relatoriopecas
 */
class Peca extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'peca';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['descricao', 'custo'], 'required'],
            [['custo'], 'number'],
            [['descricao'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idPeca' => 'Id Peca',
            'descricao' => 'Descricao',
            'custo' => 'Custo',
        ];
    }

    /**
     * Gets query for [[Relatoriopecas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRelatoriopecas()
    {
        return $this->hasMany(Relatoriopeca::className(), ['idPeca' => 'idPeca']);
    }

    public function beforeDelete()
    {
        if(sizeof($this->relatoriopecas) != 0){
            foreach ($this->relatoriopecas as $relatoriopeca){
                $relatoriopeca->delete();
            }
        }

        return parent::beforeDelete(); // TODO: Change the autogenerated stub
    }
}