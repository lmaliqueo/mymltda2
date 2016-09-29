<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Proveedor;

/**
 * ProveedorSearch represents the model behind the search form about `app\models\Proveedor`.
 */
class ProveedorSearch extends Proveedor
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PROV_ID'], 'integer'],
            [['PROV_NOMBRE', 'COM_ID','PROV_DIRECCION', 'PROV_CONTACTO','PROV_RAZONSOCIAL', 'PROV_EMAIL'], 'safe'],
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
        $query = Proveedor::find();

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

        $query->andFilterWhere([
            'PROV_ID' => $this->PROV_ID,
        ]);

        $query->andFilterWhere(['like', 'PROV_NOMBRE', $this->PROV_NOMBRE])
            ->andFilterWhere(['like', 'PROV_DIRECCION', $this->PROV_DIRECCION])
            ->andFilterWhere(['like', 'PROV_RAZONSOCIAL', $this->PROV_RAZONSOCIAL])
            ->andFilterWhere(['like', 'PROV_CONTACTO', $this->PROV_CONTACTO])
            ->andFilterWhere(['like', 'PROV_EMAIL', $this->PROV_EMAIL]);
        $query->andFilterWhere(['like', 'comuna.COM_NOMBRE', $this->COM_ID]);

        return $dataProvider;
    }
}
