<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sact_mat_consume".
 *
 * @property integer $CONS_ID
 * @property integer $MA_ID
 * @property integer $SACT_ID
 * @property integer $CONS_CANTMATERIAL
 * @property integer $CONS_COSTO
 *
 * @property Materiales $mA
 * @property Subactividades $sACT
 */
class SactMatConsume extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sact_mat_consume';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['TMA_ID', 'SACT_ID'], 'required'],
            [['TMA_ID', 'SACT_ID', 'CONS_CANTIDAD'], 'integer'],
            [['TMA_ID'], 'exist', 'skipOnError' => true, 'targetClass' => TipoMaterial::className(), 'targetAttribute' => ['TMA_ID' => 'TMA_ID']],
            [['SACT_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Subactividades::className(), 'targetAttribute' => ['SACT_ID' => 'SACT_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'CONS_ID' => 'ID',
            'TMA_ID' => 'Material',
            'SACT_ID' => 'Sub-Actividad',
            'CONS_CANTIDAD' => 'Cantidad',
            'CONS_COSTO' => 'Costo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTMA()
    {
        return $this->hasOne(TipoMaterial::className(), ['TMA_ID' => 'TMA_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSACT()
    {
        return $this->hasOne(Subactividades::className(), ['SACT_ID' => 'SACT_ID']);
    }
}
