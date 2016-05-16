<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ContratoObrero;

/**
 * ContratoObreroSearch represents the model behind the search form about `app\models\ContratoObrero`.
 */
class ContratoObreroSearch extends ContratoObrero
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['COO_ID', 'COO_SUELDO', 'COO_HORAS'], 'integer'],
            [['PE_RUT', 'COO_FECHA', 'COO_ESTADO'], 'safe'],
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
        $query = ContratoObrero::find();

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
            'COO_ID' => $this->COO_ID,
            'COO_FECHA' => $this->COO_FECHA,
            'COO_SUELDO' => $this->COO_SUELDO,
            'COO_HORAS' => $this->COO_HORAS,
        ]);

        $query->andFilterWhere(['like', 'PE_RUT', $this->PE_RUT])
            ->andFilterWhere(['like', 'COO_ESTADO', $this->COO_ESTADO]);

        return $dataProvider;
    }
}
