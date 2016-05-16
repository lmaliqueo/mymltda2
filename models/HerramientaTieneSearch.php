<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\HerramientaTiene;

/**
 * HerramientaTieneSearch represents the model behind the search form about `app\models\HerramientaTiene`.
 */
class HerramientaTieneSearch extends HerramientaTiene
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['HT_ID', 'EH_ID', 'HE_ID', 'HT_CANTHEESTADO'], 'integer'],
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
        $query = HerramientaTiene::find();

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
            'HT_ID' => $this->HT_ID,
            'EH_ID' => $this->EH_ID,
            'HE_ID' => $this->HE_ID,
            'HT_CANTHEESTADO' => $this->HT_CANTHEESTADO,
        ]);

        return $dataProvider;
    }
}
