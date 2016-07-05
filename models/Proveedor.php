<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "proveedor".
 *
 * @property integer $PROV_ID
 * @property string $PROV_NOMBRE
 * @property string $PROV_CIUDAD
 * @property string $PROV_CALLE
 * @property string $PROV_RAZONSOCIAL
 * @property string $PROV_MUNICIPIO
 * @property integer $PROV_CODIGOPOSTAL
 * @property integer $PROV_FAX
 * @property string $PROV_EMAIL
 * @property integer $PROV_CONTACTO
 *
 * @property OrdenCompra[] $ordenCompras
 */
class Proveedor extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'proveedor';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PROV_CODIGOPOSTAL', 'PROV_FAX', 'PROV_CONTACTO'], 'integer'],
            [['PROV_NOMBRE', 'PROV_CALLE', 'PROV_RAZONSOCIAL', 'PROV_MUNICIPIO', 'PROV_EMAIL'], 'string', 'max' => 50],
            [['PROV_CIUDAD'], 'string', 'max' => 30]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'PROV_ID' => 'ID',
            'PROV_NOMBRE' => 'Proveedor',
            'PROV_CIUDAD' => 'Ciudad',
            'PROV_CALLE' => 'Calle',
            'PROV_RAZONSOCIAL' => 'Razon Social',
            'PROV_MUNICIPIO' => 'Municipio',
            'PROV_CODIGOPOSTAL' => 'Codigo Postal',
            'PROV_FAX' => 'Fax',
            'PROV_EMAIL' => 'Email',
            'PROV_CONTACTO' => 'Contacto',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrdenCompras()
    {
        return $this->hasMany(OrdenCompra::className(), ['PROV_ID' => 'PROV_ID']);
    }
}
