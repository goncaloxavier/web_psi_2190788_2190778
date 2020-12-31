<?php

namespace app\models;

use common\models\Utilizador;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "relatorio".
 *
 * @property int $idRelatorio
 * @property int $idAvaria
 * @property int $idDispositivo
 * @property int $idUtilizador
 * @property string|null $descricao
 *
 * @property Avaria $idAvaria0
 * @property Relatoriopecas[] $relatoriopecas
 */
class Relatorio extends \yii\db\ActiveRecord
{
    public $descricaoA;
    public $autor;
    public $listPecas;

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
        return $this->hasMany(Relatoriopeca::className(), ['idRelatorio' => 'idRelatorio']);
    }

    public function getPecas(){

        $listaPecas = Peca::find()->all();

        $i = 1;

        foreach ($listaPecas as $peca){
            $list[$i] = $peca->descricao." ".$peca->custo."€";
            $i++;
        }

        return $list;
    }

    public function getRelatedPecas(){

        if($this->relatoriopecas != null){
            for($i = 0; $i < sizeof($this->relatoriopecas); $i++){
                $list[$i] = $this->relatoriopecas[$i]->idPeca;
            }

            return $list;
        }else{

            return $this->getPecas();
        }
    }

    public function beforeSave($insert)
    {

        /* if(sizeof($this->relatoriopecas) != 0){
             $listRelated = $this->getRelatedPecas();
             if($this->listPecas == null){
                 foreach($this->relatoriopecas as $relatoriopeca){
                     $relatoriopeca->delete();
                 }
             }
             else{
                 for($i = 0; $i < sizeof($this->listPecas); $i++){
                     if($i > sizeof($this->relatoriopecas)){
                         $modelRP = new Relatoriopeca();
                         $modelRP->idPeca = intval($this->listPecas[$i]);
                         $modelRP->idRelatorio = $this->idRelatorio;
                         $modelRP->save();
                     }else{
                         if(in_array($this->listPecas[$i], $listRelated)){
                             $this->relatoriopecas[$i]->delete();
                         }
                     }
                 }
             }
         }
         else{

         }*/

        if($this->listPecas == null){
            for($i = 0; $i < sizeof($this->relatoriopecas); $i++){
                $this->relatoriopecas[$i]->delete();
            }
        }
        else{
            if(sizeof($this->relatoriopecas) != sizeof($this->listPecas)){
                $listRelated = $this->getRelatedPecas();
                if(sizeof($this->listPecas) > sizeof($this->relatoriopecas)){
                    for($i = 0; $i < sizeof($this->listPecas); $i++){
                        if(!in_array($this->listPecas[$i], $listRelated)){
                            $modelRP = new Relatoriopeca();
                            $modelRP->idPeca = intval($this->listPecas[$i]);
                            $modelRP->idRelatorio = $this->idRelatorio;
                            $modelRP->save();
                        }
                    }
                }elseif(sizeof($this->listPecas) < sizeof($this->relatoriopecas)){
                    for($i = 0; $i < sizeof(($this->relatoriopecas)); $i++){
                        if (!in_array($listRelated[$i], $this->listPecas)) {
                            $this->relatoriopecas[$i]->delete();
                        }
                    }
                }
            }else{
                if(sizeof($this->relatoriopecas) != 0){
                  //TODO
                }else{
                    for($i = 0; $i < sizeof($this->listPecas); $i++){
                        $modelRP = new Relatoriopeca();
                        $modelRP->idPeca = intval($this->listPecas[$i]);
                        $modelRP->idRelatorio = $this->idRelatorio;
                        $modelRP->save();
                    }
                }
            }
        }

        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }

    public function afterSave($insert, $changedAttributes)
    {
        $this->idAvaria0->idRelatorio = $this->idRelatorio;

        $this->idAvaria0->save();
        parent::afterSave($insert, $changedAttributes); // TODO: Change the autogenerated stub
    }

    public function beforeDelete()
    {
        foreach ($this->relatoriopecas as $relatoriopeca){
            $relatoriopeca->delete();
        }

        $this->idAvaria0->idRelatorio == null;

        $this->idAvaria0->save();

        return parent::beforeDelete(); // TODO: Change the autogenerated stub
    }

    public function getSizePlus1(){
        return sizeof($this->relatoriopecas) + 1;
    }

    public function getAutor(){
        $utilizador = Utilizador::findOne($this->idUtilizador);

        return $utilizador->nomeUtilizador;
    }
}
