<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PedidoMateriales;

/**
 * PedidoMaterialesSearch represents the model behind the search form about `app\models\PedidoMateriales`.
 */
class PedidoMaterialesSearch extends PedidoMateriales
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PM_ID'], 'integer'],
            [['PM_ESTADO', 'PM_TITULO', 'PM_FECHA', 'PM_DESCRIPCION'], 'safe'],
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
        $query = PedidoMateriales::find();

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
            'PM_ID' => $this->PM_ID,
            'PM_FECHA' => $this->PM_FECHA,
        ]);

        $query->andFilterWhere(['like', 'PM_ESTADO', $this->PM_ESTADO])
            ->andFilterWhere(['like', 'PM_TITULO', $this->PM_TITULO])
            ->andFilterWhere(['like', 'PM_DESCRIPCION', $this->PM_DESCRIPCION]);

        return $dataProvider;
    }
}
