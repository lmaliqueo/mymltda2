<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "persona".
 *
 * @property string $PE_RUT
 * @property integer $CA_ID
 * @property string $PE_NOMBRES
 * @property string $PE_APELLIDOPAT
 * @property string $PE_APELLIDOMAT
 * @property integer $PE_TELEFONO
 *
 * @property ContratoObrero[] $contratoObreros
 * @property ManodeobraTrabajan[] $manodeobraTrabajans
 * @property Cargo $cA
 * @property SolicitudPrestamo[] $solicitudPrestamos
 * @property Usuario[] $usuarios
 */
class Persona extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'persona';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PE_RUT', 'CA_ID'], 'required'],
            [['CA_ID', 'PE_TELEFONO'], 'integer'],
            [['PE_RUT'], 'string', 'max' => 12],
            [['PE_NOMBRES', 'PE_APELLIDOPAT', 'PE_APELLIDOMAT'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'PE_RUT' => 'Rut',
            'CA_ID' => 'Cargo',
            'PE_NOMBRES' => 'Nombres',
            'PE_APELLIDOPAT' => 'Apellido Paterno',
            'PE_APELLIDOMAT' => 'Apellido Materno',
            'PE_TELEFONO' => 'Teléfono',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContratoObreros()
    {
        return $this->hasMany(ContratoObrero::className(), ['PE_RUT' => 'PE_RUT']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getManodeobraTrabajans()
    {
        return $this->hasMany(ManodeobraTrabajan::className(), ['PE_RUT' => 'PE_RUT']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCA()
    {
        return $this->hasOne(Cargo::className(), ['CA_ID' => 'CA_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSolicitudPrestamos()
    {
        return $this->hasMany(SolicitudPrestamo::className(), ['PE_RUT' => 'PE_RUT']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarios()
    {
        return $this->hasMany(Usuario::className(), ['PE_RUT' => 'PE_RUT']);
    }
}
