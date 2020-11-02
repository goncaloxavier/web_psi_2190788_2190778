<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "relatoriopeca".
 *
 * @property int $idRelatorio
 * @property int $idPeca
 *
 * @property Relatorio $idRelatorio0
 * @property Peca $idPeca0
 */
class Relatoriopeca extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'relatoriopeca';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idRelatorio', 'idPeca'], 'required'],
            [['idRelatorio', 'idPeca'], 'integer'],
            [['idRelatorio'], 'exist', 'skipOnError' => true, 'targetClass' => Relatorio::className(), 'targetAttribute' => ['idRelatorio' => 'idRelatorio']],
            [['idPeca'], 'exist', 'skipOnError' => true, 'targetClass' => Peca::className(), 'targetAttribute' => ['idPeca' => 'idPeca']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idRelatorio' => 'Id Relatorio',
            'idPeca' => 'Id Peca',
        ];
    }

    /**
     * Gets query for [[IdRelatorio0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdRelatorio0()
    {
        return $this->hasOne(Relatorio::className(), ['idRelatorio' => 'idRelatorio']);
    }

    /**
     * Gets query for [[IdPeca0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdPeca0()
    {
        return $this->hasOne(Peca::className(), ['idPeca' => 'idPeca']);
    }
}
