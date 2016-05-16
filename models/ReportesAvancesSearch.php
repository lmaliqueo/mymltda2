<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ReportesAvances;

/**
 * ReportesAvancesSearch represents the model behind the search form about `app\models\ReportesAvances`.
 */
class ReportesAvancesSearch extends ReportesAvances
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['RA_ID', 'OT_ID'], 'integer'],
            [['RA_TITULO', 'RA_DESCRIPCION', 'RA_FECHA'], 'safe'],
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
        $query = ReportesAvances::find();

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
            'RA_ID' => $this->RA_ID,
            'OT_ID' => $this->OT_ID,
            'RA_FECHA' => $this->RA_FECHA,
        ]);

        $query->andFilterWhere(['like', 'RA_TITULO', $this->RA_TITULO])
            ->andFilterWhere(['like', 'RA_DESCRIPCION', $this->RA_DESCRIPCION]);

        return $dataProvider;
    }
}
