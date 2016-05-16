<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AsignaTiene;

/**
 * AsignaTieneSearch represents the model behind the search form about `app\models\AsignaTiene`.
 */
class AsignaTieneSearch extends AsignaTiene
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['AT_ID', 'AS_ID', 'EP_ID', 'AT_CANTIDAD', 'AT_COSTO_EP'], 'integer'],
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
        $query = AsignaTiene::find();

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
            'AT_ID' => $this->AT_ID,
            'AS_ID' => $this->AS_ID,
            'EP_ID' => $this->EP_ID,
            'AT_CANTIDAD' => $this->AT_CANTIDAD,
            'AT_COSTO_EP' => $this->AT_COSTO_EP,
        ]);

        return $dataProvider;
    }
}
