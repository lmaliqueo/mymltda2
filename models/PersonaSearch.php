<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Persona;

/**
 * PersonaSearch represents the model behind the search form about `app\models\Persona`.
 */
class PersonaSearch extends Persona
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PE_RUT', 'PE_NOMBRES', 'PE_APELLIDOPAT', 'PE_APELLIDOMAT'], 'safe'],
            [['CA_ID', 'PE_TELEFONO'], 'integer'],
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
        $query = Persona::find();

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
            'PE_TELEFONO' => $this->PE_TELEFONO,
        ]);

        $query->andFilterWhere(['like', 'PE_RUT', $this->PE_RUT])
            ->andFilterWhere(['like', 'PE_NOMBRES', $this->PE_NOMBRES])
            ->andFilterWhere(['like', 'PE_APELLIDOPAT', $this->PE_APELLIDOPAT])
            ->andFilterWhere(['like', 'PE_APELLIDOMAT', $this->PE_APELLIDOMAT]);

        return $dataProvider;
    }
}
