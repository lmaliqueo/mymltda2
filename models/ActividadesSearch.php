<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Actividades;

/**
 * ActividadesSearch represents the model behind the search form about `app\models\Actividades`.
 */
class ActividadesSearch extends Actividades
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['AC_ID', 'OT_ID', 'AC_COSTO_TOTAL'], 'integer'],
            [['AC_NOMBRE', 'AC_FECHA_INICIO', 'AC_FECHA_TERMINO', 'AC_ESTADO'], 'safe'],
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
        $query = Actividades::find();

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
            'AC_ID' => $this->AC_ID,
            'OT_ID' => $this->OT_ID,
            'AC_FECHA_INICIO' => $this->AC_FECHA_INICIO,
            'AC_FECHA_TERMINO' => $this->AC_FECHA_TERMINO,
            'AC_COSTO_TOTAL' => $this->AC_COSTO_TOTAL,
        ]);

        $query->andFilterWhere(['like', 'AC_NOMBRE', $this->AC_NOMBRE])
            ->andFilterWhere(['like', 'AC_ESTADO', $this->AC_ESTADO]);

        return $dataProvider;
    }
}
