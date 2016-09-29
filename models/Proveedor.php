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
 * @property integer $COM_ID
 * @property string $PROV_RAZONSOCIAL
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
           [['COM_ID'], 'required'],
           [['COM_ID'], 'integer'],
           [['PROV_NOMBRE', 'PROV_RAZONSOCIAL', 'PROV_EMAIL'], 'string', 'max' => 50],
           [['PROV_DIRECCION'], 'string', 'max' => 100],
           [['PROV_CONTACTO'], 'string', 'max' => 20], 
           [['COM_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Comuna::className(), 'targetAttribute' => ['COM_ID' => 'COM_ID']], 
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'PROV_ID' => 'ID',
            'PROV_NOMBRE' => 'Nombre',
            'PROV_DIRECCION' => 'Direccion',
            'PROV_RAZONSOCIAL' => 'Razonsocial',
            'PROV_EMAIL' => 'Email',
            'PROV_CONTACTO' => 'Contacto',
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

    public function getCOM()
    {
        return $this->hasOne(Comuna::className(), ['COM_ID' => 'COM_ID']);
    }
}
