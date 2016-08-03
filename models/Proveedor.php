<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "proveedor".
 *
 * @property integer $PROV_ID
 * @property string $PROV_NOMBRE
 * @property string $PROV_CIUDAD
 * @property string $PROV_DIRECCION
 * @property string $PROV_RAZONSOCIAL
 * @property string $PROV_EMAIL
 * @property integer $PROV_CONTACTO
 *
 * @property Herramientas[] $herramientas
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
            [['PROV_CONTACTO'], 'integer'],
            [['PROV_NOMBRE', 'PROV_RAZONSOCIAL', 'PROV_EMAIL'], 'string', 'max' => 50],
            [['PROV_CIUDAD'], 'string', 'max' => 30],
            [['PROV_DIRECCION'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'PROV_ID' => 'Prov  ID',
            'PROV_NOMBRE' => 'Prov  Nombre',
            'PROV_CIUDAD' => 'Prov  Ciudad',
            'PROV_DIRECCION' => 'Prov  Direccion',
            'PROV_RAZONSOCIAL' => 'Prov  Razonsocial',
            'PROV_EMAIL' => 'Prov  Email',
            'PROV_CONTACTO' => 'Prov  Contacto',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHerramientas()
    {
        return $this->hasMany(Herramientas::className(), ['PROV_ID' => 'PROV_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrdenCompras()
    {
        return $this->hasMany(OrdenCompra::className(), ['PROV_ID' => 'PROV_ID']);
    }
}
