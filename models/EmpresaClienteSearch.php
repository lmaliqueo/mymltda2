<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\EmpresaCliente;

/**
 * EmpresaClienteSearch represents the model behind the search form about `app\models\EmpresaCliente`.
 */
class EmpresaClienteSearch extends EmpresaCliente
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['EMP_RUT', 'EMP_RAZON', 'EMP_NOMBRE', 'EMP_RUBRO', 'EMP_DIRECCION'], 'safe'],
            [['COM_ID', 'EMP_TELEFONO'], 'integer'],
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
        $query = EmpresaCliente::find();

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

        // grid filtering conditions
        $query->andFilterWhere([
            'COM_ID' => $this->COM_ID,
            'EMP_TELEFONO' => $this->EMP_TELEFONO,
        ]);

        $query->andFilterWhere(['like', 'EMP_RUT', $this->EMP_RUT])
            ->andFilterWhere(['like', 'EMP_RAZON', $this->EMP_RAZON])
            ->andFilterWhere(['like', 'EMP_NOMBRE', $this->EMP_NOMBRE])
            ->andFilterWhere(['like', 'EMP_RUBRO', $this->EMP_RUBRO])
            ->andFilterWhere(['like', 'EMP_DIRECCION', $this->EMP_DIRECCION]);

        return $dataProvider;
    }
}
