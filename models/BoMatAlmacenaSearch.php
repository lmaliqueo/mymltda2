<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\BoMatAlmacena;

/**
 * BoMatAlmacenaSearch represents the model behind the search form about `app\models\BoMatAlmacena`.
 */
class BoMatAlmacenaSearch extends BoMatAlmacena
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['AL_ID', 'BO_ID', 'MA_ID', 'OT_ID', 'AL_CANTMATERIALES'], 'integer'],
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
        $query = BoMatAlmacena::find();

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
            'AL_ID' => $this->AL_ID,
            'BO_ID' => $this->BO_ID,
            'OT_ID' => $this->BO_ID,
            'MA_ID' => $this->MA_ID,
            'AL_CANTMATERIALES' => $this->AL_CANTMATERIALES,
        ]);

        return $dataProvider;
    }
}
