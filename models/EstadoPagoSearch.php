<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\EstadoPago;

/**
 * EstadoPagoSearch represents the model behind the search form about `app\models\EstadoPago`.
 */
class EstadoPagoSearch extends EstadoPago
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['EP_ID', 'EP_NUMEROEP', 'EP_PERIODO', 'EP_TOTALEP'], 'integer'],
            [['EP_FECHA', 'EP_FACTURA'], 'safe'],
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
        $query = EstadoPago::find();

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
            'EP_ID' => $this->EP_ID,
            'EP_NUMEROEP' => $this->EP_NUMEROEP,
            'EP_FECHA' => $this->EP_FECHA,
            'EP_PERIODO' => $this->EP_PERIODO,
            'EP_TOTALEP' => $this->EP_TOTALEP,
        ]);

        $query->andFilterWhere(['like', 'EP_FACTURA', $this->EP_FACTURA]);

        return $dataProvider;
    }
}
