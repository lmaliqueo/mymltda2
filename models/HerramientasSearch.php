<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Herramientas;

/**
 * HerramientasSearch represents the model behind the search form about `app\models\Herramientas`.
 */
class HerramientasSearch extends Herramientas
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['HE_ID', 'BO_ID', 'HE_CANT', 'HE_COSTOUNIDAD'], 'integer'],
            [['HE_NOMBRE'], 'safe'],
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
        $query = Herramientas::find();

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
            'HE_ID' => $this->HE_ID,
            'BO_ID' => $this->BO_ID,
            'HE_CANT' => $this->HE_CANT,
            'HE_COSTOUNIDAD' => $this->HE_COSTOUNIDAD,
        ]);

        $query->andFilterWhere(['like', 'HE_NOMBRE', $this->HE_NOMBRE]);

        return $dataProvider;
    }
}
