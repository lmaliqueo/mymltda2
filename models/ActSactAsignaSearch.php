<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ActSactAsigna;

/**
 * ActSactAsignaSearch represents the model behind the search form about `app\models\ActSactAsigna`.
 */
class ActSactAsignaSearch extends ActSactAsigna
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['AS_ID', 'AC_ID', 'SACT_ID', 'AS_CANTIDAD', 'AS_COSTOTOTAL'], 'integer'],
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
        $query = ActSactAsigna::find();

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
            'AS_ID' => $this->AS_ID,
            'AC_ID' => $this->AC_ID,
            'SACT_ID' => $this->SACT_ID,
            'AS_CANTIDAD' => $this->AS_CANTIDAD,
            'AS_COSTOTOTAL' => $this->AS_COSTOTOTAL,
        ]);

        return $dataProvider;
    }
}
