<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Ciudad;

/**
 * CiudadSearch represents the model behind the search form about `app\models\Ciudad`.
 */
class CiudadSearch extends Ciudad
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CIU_ID'], 'integer'],
            [['CIU_NOMBRE'], 'safe'],
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
        $query = Ciudad::find();

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
            'CIU_ID' => $this->CIU_ID,
        ]);

        $query->andFilterWhere(['like', 'CIU_NOMBRE', $this->CIU_NOMBRE]);

        return $dataProvider;
    }
}
