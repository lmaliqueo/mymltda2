<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "estado_pago".
 *
 * @property integer $EP_ID
 * @property integer $EP_NUMEROEP
 * @property string $EP_FECHA
 * @property integer $EP_PERIODO
 * @property integer $EP_TOTALEP
 * @property string $EP_FACTURA
 *
 * @property AsignaTiene[] $asignaTienes
 */
class EstadoPago extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'estado_pago';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['EP_NUMEROEP', 'EP_PERIODO', 'EP_TOTALEP'], 'integer'],
            [['EP_FECHA'], 'safe'],
            [['EP_FACTURA'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'EP_ID' => 'ID',
            'EP_NUMEROEP' => 'Numero',
            'EP_FECHA' => 'Fecha',
            'EP_PERIODO' => 'Periodo',
            'EP_TOTALEP' => 'Total Estado de Pago',
            'EP_FACTURA' => 'Factura',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAsignaTienes()
    {
        return $this->hasMany(AsignaTiene::className(), ['EP_ID' => 'EP_ID']);
    }
}
