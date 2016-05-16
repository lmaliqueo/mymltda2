<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "empresa_cliente".
 *
 * @property string $EMP_RUT
 * @property integer $COM_ID
 * @property string $EMP_RAZON
 * @property string $EMP_NOMBRE
 * @property string $EMP_RUBRO
 * @property string $EMP_DIRECCION
 * @property string $EMP_CIUDAD
 * @property integer $EMP_TELEFONO
 *
 * @property Comuna $cOM
 * @property LicitacionPublica[] $licitacionPublicas
 * @property Proyecto[] $proyectos
 */
class EmpresaCliente extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'empresa_cliente';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['EMP_RUT', 'COM_ID'], 'required'],
            [['COM_ID', 'EMP_TELEFONO'], 'integer'],
            [['EMP_RUT'], 'string', 'max' => 15],
            [['EMP_RAZON', 'EMP_NOMBRE', 'EMP_RUBRO', 'EMP_DIRECCION'], 'string', 'max' => 50],
            [['COM_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Comuna::className(), 'targetAttribute' => ['COM_ID' => 'COM_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'EMP_RUT' => 'Rut',
            'COM_ID' => 'Comuna',
            'EMP_RAZON' => 'Razon Social',
            'EMP_NOMBRE' => 'Cliente',
            'EMP_RUBRO' => 'Rubro',
            'EMP_DIRECCION' => 'Dirección',
            'EMP_TELEFONO' => 'Teléfono',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCOM()
    {
        return $this->hasOne(Comuna::className(), ['COM_ID' => 'COM_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLicitacionPublicas()
    {
        return $this->hasMany(LicitacionPublica::className(), ['EMP_RUT' => 'EMP_RUT']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProyectos()
    {
        return $this->hasMany(Proyecto::className(), ['EMP_RUT' => 'EMP_RUT']);
    }
}
