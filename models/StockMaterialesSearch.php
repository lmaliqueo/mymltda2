<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\StockMateriales;

/**
 * StockMaterialesSearch represents the model behind the search form about `app\models\StockMateriales`.
 */
class StockMaterialesSearch extends StockMateriales
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['SM_ID', 'OT_ID', 'MA_ID', 'SM_CANTIDAD'], 'integer'],
            [['SM_ESTADO'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = StockMateriales::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'SM_ID' => $this->SM_ID,
            'OT_ID' => $this->OT_ID,
            'MA_ID' => $this->MA_ID,
            'SM_CANTIDAD' => $this->SM_CANTIDAD,
        ]);

        $query->andFilterWhere(['like', 'SM_ESTADO', $this->SM_ESTADO]);

        return $dataProvider;
    }
}
