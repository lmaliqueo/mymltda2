<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Usuario;

/**
 * UsuarioSearch represents the model behind the search form about `app\models\Usuario`.
 */
class UsuarioSearch extends Usuario
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['US_ID'], 'integer'],
            [['PE_RUT', 'US_USSERNAME', 'US_PASSWORD', 'US_EMAIL', 'US_TIPO', 'US_DESCRIPCION'], 'safe'],
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
        $query = Usuario::find();

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
            'US_ID' => $this->US_ID,
        ]);

        $query->andFilterWhere(['like', 'PE_RUT', $this->PE_RUT])
            ->andFilterWhere(['like', 'US_USSERNAME', $this->US_USSERNAME])
            ->andFilterWhere(['like', 'US_PASSWORD', $this->US_PASSWORD])
            ->andFilterWhere(['like', 'US_EMAIL', $this->US_EMAIL])
            ->andFilterWhere(['like', 'US_TIPO', $this->US_TIPO])
            ->andFilterWhere(['like', 'US_DESCRIPCION', $this->US_DESCRIPCION]);

        return $dataProvider;
    }
}
