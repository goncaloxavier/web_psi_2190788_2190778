<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Dispositivo;
/**
 * AvariaSearch represents the model behind the search form of `app\models\Avaria`.
 */
class AvariaSearch extends Avaria
{
    /**
     * {@inheritdoc}
     */
    public $search;

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
    public function search($params, $search)
    {
        if($search != null){
            if($modelDispositivo = Dispositivo::find()->where(['referencia' => $search])->one()){
                $query = Avaria::findBySql("SELECT * FROM avaria 
                    WHERE avaria.estado IN (2,1,0) 
                    and idDispositivo = ".$modelDispositivo->idDispositivo." 
                    ORDER BY FIELD(avaria.estado,0,1,2), avaria.data DESC");
            }
            else{
                $query = Avaria::find()->where(['idAvaria' => -1]);
            }
        }else{
            if(\Yii::$app->user->identity->tipo == 0){
                $query = Avaria::findBySql("SELECT * FROM avaria 
                    WHERE avaria.estado IN (2,1,0) 
                    and idUtilizador = ".\Yii::$app->user->identity->idUtilizador." 
                    ORDER BY FIELD(avaria.estado,0,1,2), avaria.data DESC");
            }else {
                $query = Avaria::findBySql("SELECT * FROM avaria 
                    WHERE avaria.estado IN (2,1,0) 
                    ORDER BY FIELD(avaria.estado,0,1,2), avaria.data DESC");
            }
        }

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

        return $dataProvider;
    }
}
