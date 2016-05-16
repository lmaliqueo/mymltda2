<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SueldoObrero;

/**
 * SueldoObreroSearch represents the model behind the search form about `app\models\SueldoObrero`.
 */
class SueldoObreroSearch extends SueldoObrero
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['SU_ID', 'COO_ID', 'SU_CANTIDAD'], 'integer'],
            [['SU_FECHA'], 'safe'],
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
        $query = SueldoObrero::find();

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
            'SU_ID' => $this->SU_ID,
            'COO_ID' => $this->COO_ID,
            'SU_CANTIDAD' => $this->SU_CANTIDAD,
            'SU_FECHA' => $this->SU_FECHA,
        ]);

        return $dataProvider;
    }
}
