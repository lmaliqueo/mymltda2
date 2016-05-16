<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SactMatConsume;

/**
 * SactMatConsumeSearch represents the model behind the search form about `app\models\SactMatConsume`.
 */
class SactMatConsumeSearch extends SactMatConsume
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CONS_ID', 'MA_ID', 'SACT_ID', 'CONS_CANTMATERIAL', 'CONS_COSTO'], 'integer'],
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
        $query = SactMatConsume::find();

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
            'CONS_ID' => $this->CONS_ID,
            'MA_ID' => $this->MA_ID,
            'SACT_ID' => $this->SACT_ID,
            'CONS_CANTMATERIAL' => $this->CONS_CANTMATERIAL,
            'CONS_COSTO' => $this->CONS_COSTO,
        ]);

        return $dataProvider;
    }
}
