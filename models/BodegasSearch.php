<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Bodegas;

/**
 * BodegasSearch represents the model behind the search form about `app\models\Bodegas`.
 */
class BodegasSearch extends Bodegas
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['BO_ID', 'BO_CANTIDADHERRAMIENTAS', 'BO_CANTIDADMATERIALES'], 'integer'],
            [['BO_NOMBRE', 'BO_DIRECCION'], 'safe'],
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
        $query = Bodegas::find();

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
            'BO_ID' => $this->BO_ID,
            'BO_CANTIDADHERRAMIENTAS' => $this->BO_CANTIDADHERRAMIENTAS,
            'BO_CANTIDADMATERIALES' => $this->BO_CANTIDADMATERIALES,
        ]);

        $query->andFilterWhere(['like', 'BO_NOMBRE', $this->BO_NOMBRE])
            ->andFilterWhere(['like', 'BO_DIRECCION', $this->BO_DIRECCION]);

        return $dataProvider;
    }
}
