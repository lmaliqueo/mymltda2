<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\GastosGenerales;

/**
 * GastosGeneralesSearch represents the model behind the search form about `app\models\GastosGenerales`.
 */
class GastosGeneralesSearch extends GastosGenerales
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['GG_ID', 'OT_ID', 'GG_COSTO'], 'integer'],
            [['GG_TIPO', 'GG_DESCRIPCION', 'GG_TEXT'], 'safe'],
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
        $query = GastosGenerales::find();

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
            'GG_ID' => $this->GG_ID,
            'OT_ID' => $this->OT_ID,
            'GG_COSTO' => $this->GG_COSTO,
        ]);

        $query->andFilterWhere(['like', 'GG_TIPO', $this->GG_TIPO])
            ->andFilterWhere(['like', 'GG_DESCRIPCION', $this->GG_DESCRIPCION])
            ->andFilterWhere(['like', 'GG_TEXT', $this->GG_TEXT]);

        return $dataProvider;
    }
}
