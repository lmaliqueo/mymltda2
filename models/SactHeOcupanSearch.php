<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SactHeOcupan;

/**
 * SactHeOcupanSearch represents the model behind the search form about `app\models\SactHeOcupan`.
 */
class SactHeOcupanSearch extends SactHeOcupan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['OC_ID', 'HE_ID', 'SACT_ID'], 'integer'],
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
        $query = SactHeOcupan::find();

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
            'OC_ID' => $this->OC_ID,
            'HE_ID' => $this->HE_ID,
            'SACT_ID' => $this->SACT_ID,
        ]);

        return $dataProvider;
    }
}
