<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sueldo_obrero".
 *
 * @property integer $SU_ID
 * @property integer $COO_ID
 * @property integer $SU_CANTIDAD
 * @property string $SU_FECHA
 *
 * @property ContratoObrero $cOO
 */
class SueldoObrero extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sueldo_obrero';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['COO_ID'], 'required'],
            [['COO_ID', 'SU_CANTIDAD'], 'integer'],
            [['SU_FECHA'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'SU_ID' => 'ID',
            'COO_ID' => 'Contrato',
            'SU_CANTIDAD' => 'Sueldo',
            'SU_FECHA' => 'Fecha',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCOO()
    {
        return $this->hasOne(ContratoObrero::className(), ['COO_ID' => 'COO_ID']);
    }
}
