<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SpreHeSolicita;

/**
 * SpreHeSolicitaSearch represents the model behind the search form about `app\models\SpreHeSolicita`.
 */
class SpreHeSolicitaSearch extends SpreHeSolicita
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['SOLI_ID', 'SPRE_ID', 'HE_ID', 'SOLI_CANTIDAD'], 'integer'],
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
        $query = SpreHeSolicita::find();

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
            'SOLI_ID' => $this->SOLI_ID,
            'SPRE_ID' => $this->SPRE_ID,
            'HE_ID' => $this->HE_ID,
            'SOLI_CANTIDAD' => $this->SOLI_CANTIDAD,
        ]);

        return $dataProvider;
    }
}
