<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "solicitud_prestamo".
 *
 * @property integer $SPRE_ID
 * @property string $PE_RUT
 * @property string $SPRE_DESCRIPCION
 * @property string $SPRE_FECHA
 * @property string $SPRE_ESTADO
 * @property string $SPRE_TEXTO
 *
 * @property Persona $pERUT
 * @property SpreHeSolicita[] $spreHeSolicitas
 */
class SolicitudPrestamo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'solicitud_prestamo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PE_RUT'], 'required'],
            [['SPRE_FECHA'], 'safe'],
            [['SPRE_DESCRIPCION'], 'string'],
            [['PE_RUT'], 'string', 'max' => 12],
            [['SPRE_TITULO'], 'string', 'max' => 50],
            [['SPRE_ESTADO'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'SPRE_ID' => 'ID',
            'PE_RUT' => 'Persona',
            'SPRE_TITULO' => 'Título',
            'SPRE_FECHA' => 'Fecha',
            'SPRE_ESTADO' => 'Estado',
            'SPRE_DESCRIPCION' => 'Descripción',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPERUT()
    {
        return $this->hasOne(Persona::className(), ['PE_RUT' => 'PE_RUT']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSpreHeSolicitas()
    {
        return $this->hasMany(SpreHeSolicita::className(), ['SPRE_ID' => 'SPRE_ID']);
    }
}
