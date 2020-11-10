<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Avaria;

/**
 * AvariaSearch represents the model behind the search form of `app\models\Avaria`.
 */
class AvariaSearch extends Avaria
{
    public $search;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idAvaria', 'tipo', 'estado', 'gravidade', 'idDispositivo', 'idRelatorio'], 'integer'],
            [['descricao', 'data', 'search'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Avaria::findBySql("SELECT * FROM avaria WHERE avaria.estado IN (3,2,1, 0) ORDER BY FIELD(avaria.estado,0,1,2,3), data desc");

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'idAvaria' => $this->idAvaria,
            'tipo' => $this->tipo,
            'avaria.estado' => $this->estado,
            'gravidade' => $this->gravidade,
            'data' => $this->data,
            'idDispositivo' => $this->idDispositivo,
            'idRelatorio' => $this->idRelatorio,
        ]);

        return $dataProvider;
    }
}
