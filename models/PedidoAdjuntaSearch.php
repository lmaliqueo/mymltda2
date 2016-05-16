<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PedidoAdjunta;

/**
 * PedidoAdjuntaSearch represents the model behind the search form about `app\models\PedidoAdjunta`.
 */
class PedidoAdjuntaSearch extends PedidoAdjunta
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PA_ID', 'PM_ID', 'SM_ID', 'PA_CANTIDADMAT'], 'integer'],
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
        $query = PedidoAdjunta::find();

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
            'PA_ID' => $this->PA_ID,
            'PM_ID' => $this->PM_ID,
            'SM_ID' => $this->SM_ID,
            'PA_CANTIDADMAT' => $this->PA_CANTIDADMAT,
        ]);

        return $dataProvider;
    }
}
