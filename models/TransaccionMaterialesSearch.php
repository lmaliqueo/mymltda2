<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TransaccionMateriales;

/**
 * TransaccionMaterialesSearch represents the model behind the search form about `app\models\TransaccionMateriales`.
 */
class TransaccionMaterialesSearch extends TransaccionMateriales
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['TM_ID', 'SM_ID', 'TM_PRECIO', 'TM_CANTIDAD'], 'integer'],
            [['TM_FECHACOMPRA'], 'safe'],
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
        $query = TransaccionMateriales::find();

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
            'TM_ID' => $this->TM_ID,
            'SM_ID' => $this->SM_ID,
            'TM_FECHACOMPRA' => $this->TM_FECHACOMPRA,
            'TM_PRECIO' => $this->TM_PRECIO,
            'TM_CANTIDAD' => $this->TM_CANTIDAD,
        ]);

        return $dataProvider;
    }
}
