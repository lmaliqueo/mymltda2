<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Subactividades;

/**
 * SubactividadesSearch represents the model behind the search form about `app\models\Subactividades`.
 */
class SubactividadesSearch extends Subactividades
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['SACT_ID', 'SACT_COSTO'], 'integer'],
            [['SACT_NOMBRE', 'SACT_DESCRIPCION'], 'safe'],
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
        $query = Subactividades::find();

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
            'SACT_ID' => $this->SACT_ID,
            'SACT_COSTO' => $this->SACT_COSTO,
        ]);

        $query->andFilterWhere(['like', 'SACT_NOMBRE', $this->SACT_NOMBRE])
            ->andFilterWhere(['like', 'SACT_DESCRIPCION', $this->SACT_DESCRIPCION]);

        return $dataProvider;
    }
}
