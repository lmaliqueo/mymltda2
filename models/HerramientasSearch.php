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
            [['HE_ID', 'HE_CANT', 'HE_COSTOUNIDAD'], 'integer'],
            [['BO_ID', 'TH_ID', 'HE_NOMBRE'], 'safe'],
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

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        $query->joinWith('tH');
        $query->joinWith('bO');
        // grid filtering conditions
        $query->andFilterWhere([
            'HE_ID' => $this->HE_ID,
            'HE_CANT' => $this->HE_CANT,
            'HE_COSTOUNIDAD' => $this->HE_COSTOUNIDAD,
        ]);

        $query->andFilterWhere(['like', 'HE_NOMBRE', $this->HE_NOMBRE]);
        $query->andFilterWhere(['like', 'tipo_herramienta.TH_NOMBRE', $this->TH_ID]);
        $query->andFilterWhere(['like', 'bodegas.BO_NOMBRE', $this->BO_ID]);

        return $dataProvider;
    }
}
