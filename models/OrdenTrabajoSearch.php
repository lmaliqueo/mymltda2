<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\OrdenTrabajo;

/**
 * OrdenTrabajoSearch represents the model behind the search form about `app\models\OrdenTrabajo`.
 */
class OrdenTrabajoSearch extends OrdenTrabajo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['OT_ID', 'OT_COSTO_TOTAL'], 'integer'],
            [['PRO_ID', 'OT_NOMBRE', 'OT_FECHA_INICIO', 'OT_FECHA_TERMINO', 'OT_ESTADO'], 'safe'],
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
        $query = OrdenTrabajo::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->joinWith('pRO');
        $query->andFilterWhere([
            'OT_ID' => $this->OT_ID,
            //'PRO_ID' => $this->PRO_ID,
            'OT_FECHA_INICIO' => $this->OT_FECHA_INICIO,
            'OT_FECHA_TERMINO' => $this->OT_FECHA_TERMINO,
            'OT_COSTO_TOTAL' => $this->OT_COSTO_TOTAL,
        ]);

        $query->andFilterWhere(['like', 'proyecto.PRO_NOMBRE', $this->PRO_ID])
            ->andFilterWhere(['like', 'OT_NOMBRE', $this->OT_NOMBRE])
            ->andFilterWhere(['like', 'OT_ESTADO', $this->OT_ESTADO]);

        return $dataProvider;
    }
}
