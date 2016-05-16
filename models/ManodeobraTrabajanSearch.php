<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ManodeobraTrabajan;

/**
 * ManodeobraTrabajanSearch represents the model behind the search form about `app\models\ManodeobraTrabajan`.
 */
class ManodeobraTrabajanSearch extends ManodeobraTrabajan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['TRAB_ID', 'AC_ID'], 'integer'],
            [['PE_RUT'], 'safe'],
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
        $query = ManodeobraTrabajan::find();

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
            'TRAB_ID' => $this->TRAB_ID,
            'AC_ID' => $this->AC_ID,
        ]);

        $query->andFilterWhere(['like', 'PE_RUT', $this->PE_RUT]);

        return $dataProvider;
    }
}
