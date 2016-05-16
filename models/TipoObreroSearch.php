<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TipoObrero;

/**
 * TipoObreroSearch represents the model behind the search form about `app\models\TipoObrero`.
 */
class TipoObreroSearch extends TipoObrero
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['TOB_ID'], 'integer'],
            [['TOB_NOMBRE', 'TOB_DESCRIPCION'], 'safe'],
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
        $query = TipoObrero::find();

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
            'TOB_ID' => $this->TOB_ID,
        ]);

        $query->andFilterWhere(['like', 'TOB_NOMBRE', $this->TOB_NOMBRE])
            ->andFilterWhere(['like', 'TOB_DESCRIPCION', $this->TOB_DESCRIPCION]);

        return $dataProvider;
    }
}
