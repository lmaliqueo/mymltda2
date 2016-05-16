<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\LicitacionPublica;

/**
 * LicitacionPublicaSearch represents the model behind the search form about `app\models\LicitacionPublica`.
 */
class LicitacionPublicaSearch extends LicitacionPublica
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['LI_ID'], 'integer'],
            [['LI_ORGANIZACIONRESPONSABLE', 'LI_NOMBRELICITACION', 'LI_DESCRIPCION', 'LI_DETALLESLICITACION', 'LI_FECHAPOSTULACION', 'LI_ESTADO', 'LI_CIUDAD'], 'safe'],
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
        $query = LicitacionPublica::find();

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
            'LI_ID' => $this->LI_ID,
            'LI_FECHAPOSTULACION' => $this->LI_FECHAPOSTULACION,
        ]);

        $query->andFilterWhere(['like', 'LI_ORGANIZACIONRESPONSABLE', $this->LI_ORGANIZACIONRESPONSABLE])
            ->andFilterWhere(['like', 'LI_NOMBRELICITACION', $this->LI_NOMBRELICITACION])
            ->andFilterWhere(['like', 'LI_DESCRIPCION', $this->LI_DESCRIPCION])
            ->andFilterWhere(['like', 'LI_DETALLESLICITACION', $this->LI_DETALLESLICITACION])
            ->andFilterWhere(['like', 'LI_ESTADO', $this->LI_ESTADO])
            ->andFilterWhere(['like', 'LI_CIUDAD', $this->LI_CIUDAD]);

        return $dataProvider;
    }
}
