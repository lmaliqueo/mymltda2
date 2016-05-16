<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\EstadoHerramientas;

/**
 * EstadoHerramientasSearch represents the model behind the search form about `app\models\EstadoHerramientas`.
 */
class EstadoHerramientasSearch extends EstadoHerramientas
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['EH_ID'], 'integer'],
            [['EH_NOMBREESTADO', 'EH_DESCRIPCION'], 'safe'],
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
        $query = EstadoHerramientas::find();

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
            'EH_ID' => $this->EH_ID,
        ]);

        $query->andFilterWhere(['like', 'EH_NOMBREESTADO', $this->EH_NOMBREESTADO])
            ->andFilterWhere(['like', 'EH_DESCRIPCION', $this->EH_DESCRIPCION]);

        return $dataProvider;
    }
}
