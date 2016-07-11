<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Proyecto;

/**
 * ProyectoSearch represents the model behind the search form about `app\models\Proyecto`.
 */
class ProyectoSearch extends Proyecto
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PRO_ID', 'PRO_COSTO_TOTAL'], 'integer'],
            [['COM_ID', 'EMP_RUT', 'PRO_NOMBRE', 'PRO_OBSERVACIONES', 'PRO_DESCRIPCION', 'PRO_DIRECCION', 'PRO_FECHA_INICIO', 'PRO_FECHA_FINAL', 'PRO_INFORME', 'PRO_ESTADO'], 'safe'],
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
        $query = Proyecto::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->joinWith('cOM');
        $query->joinWith('eMPRUT');

        // grid filtering conditions
        $query->andFilterWhere([
            'PRO_ID' => $this->PRO_ID,
            'PRO_COSTO_TOTAL' => $this->PRO_COSTO_TOTAL,
            'PRO_FECHA_INICIO' => $this->PRO_FECHA_INICIO,
            'PRO_FECHA_FINAL' => $this->PRO_FECHA_FINAL,
            'PRO_DIRECCION' => $this->PRO_DIRECCION,
        ]);

        $query->andFilterWhere(['like', 'empresa-cliente.EMP_RUT', $this->EMP_RUT])
            ->andFilterWhere(['like', 'PRO_NOMBRE', $this->PRO_NOMBRE])
            ->andFilterWhere(['like', 'PRO_OBSERVACIONES', $this->PRO_OBSERVACIONES])
            ->andFilterWhere(['like', 'PRO_DESCRIPCION', $this->PRO_DESCRIPCION])
            ->andFilterWhere(['like', 'PRO_DIRECCION', $this->PRO_DIRECCION])
            ->andFilterWhere(['like', 'PRO_INFORME', $this->PRO_INFORME])
            ->andFilterWhere(['like', 'PRO_ESTADO', $this->PRO_ESTADO]);
        $query->andFilterWhere(['like', 'comuna.COM_NOMBRE', $this->COM_ID]);

        return $dataProvider;
    }
}
