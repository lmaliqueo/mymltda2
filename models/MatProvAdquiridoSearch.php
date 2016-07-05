<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MatProvAdquirido;

/**
 * MatProvAdquiridoSearch represents the model behind the search form about `app\models\MatProvAdquirido`.
 */
class MatProvAdquiridoSearch extends MatProvAdquirido
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['AD_ID', 'PROV_ID', 'MA_ID', 'TM_ID'], 'integer'],
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
        $query = MatProvAdquirido::find();

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
            'AD_ID' => $this->AD_ID,
            'PROV_ID' => $this->PROV_ID,
            'MA_ID' => $this->MA_ID,
            'SM_ID' => $this->SM_ID,
        ]);

        return $dataProvider;
    }
}
