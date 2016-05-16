<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\UsuariosControla;

/**
 * UsuariosControlaSearch represents the model behind the search form about `app\models\UsuariosControla`.
 */
class UsuariosControlaSearch extends UsuariosControla
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['USCON_ID', 'US_ID', 'PRO_ID'], 'integer'],
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
        $query = UsuariosControla::find();

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
            'USCON_ID' => $this->USCON_ID,
            'US_ID' => $this->US_ID,
            'PRO_ID' => $this->PRO_ID,
        ]);

        return $dataProvider;
    }
}
