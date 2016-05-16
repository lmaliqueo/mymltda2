<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SolicitudPrestamo;

/**
 * SolicitudPrestamoSearch represents the model behind the search form about `app\models\SolicitudPrestamo`.
 */
class SolicitudPrestamoSearch extends SolicitudPrestamo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['SPRE_ID'], 'integer'],
            [['PE_RUT', 'SPRE_TITULO', 'SPRE_FECHA', 'SPRE_ESTADO', 'SPRE_DESCRIPCION'], 'safe'],
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
        $query = SolicitudPrestamo::find();

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
            'SPRE_ID' => $this->SPRE_ID,
            'SPRE_FECHA' => $this->SPRE_FECHA,
        ]);

        $query->andFilterWhere(['like', 'PE_RUT', $this->PE_RUT])
            ->andFilterWhere(['like', 'SPRE_TITULO', $this->SPRE_TITULO])
            ->andFilterWhere(['like', 'SPRE_ESTADO', $this->SPRE_ESTADO])
            ->andFilterWhere(['like', 'SPRE_DESCRIPCION', $this->SPRE_DESCRIPCION]);

        return $dataProvider;
    }
}
