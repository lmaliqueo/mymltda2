<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sact_ob_requiere".
 *
 * @property integer $RE_ID
 * @property integer $TOB_ID
 * @property integer $SACT_ID
 * @property integer $RE_CANTIDAD
 *
 * @property TipoObrero $tOB
 * @property Subactividades $sACT
 */
class SactObRequiere extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sact_ob_requiere';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['TOB_ID', 'SACT_ID', 'RE_CANTIDAD'], 'integer'],
            [['TOB_ID'], 'exist', 'skipOnError' => true, 'targetClass' => TipoObrero::className(), 'targetAttribute' => ['TOB_ID' => 'TOB_ID']],
            [['SACT_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Subactividades::className(), 'targetAttribute' => ['SACT_ID' => 'SACT_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'RE_ID' => 'ID',
            'TOB_ID' => 'Tipo Obrero',
            'SACT_ID' => 'Sact  ID',
            'RE_CANTIDAD' => 'Cantidad',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTOB()
    {
        return $this->hasOne(TipoObrero::className(), ['TOB_ID' => 'TOB_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSACT()
    {
        return $this->hasOne(Subactividades::className(), ['SACT_ID' => 'SACT_ID']);
    }
}
