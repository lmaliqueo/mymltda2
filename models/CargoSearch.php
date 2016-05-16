<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Cargo;

/**
 * CargoSearch represents the model behind the search form about `app\models\Cargo`.
 */
class CargoSearch extends Cargo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CA_ID'], 'integer'],
            [['CA_NOMBRECARGO', 'CA_DESCRIPCION'], 'safe'],
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
        $query = Cargo::find();

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
            'CA_ID' => $this->CA_ID,
        ]);

        $query->andFilterWhere(['like', 'CA_NOMBRECARGO', $this->CA_NOMBRECARGO])
            ->andFilterWhere(['like', 'CA_DESCRIPCION', $this->CA_DESCRIPCION]);

        return $dataProvider;
    }
}
