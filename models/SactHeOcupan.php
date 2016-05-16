<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sact_he_ocupan".
 *
 * @property integer $OC_ID
 * @property integer $HE_ID
 * @property integer $SACT_ID
 * @property integer $OC_CANTHERRAMIENTA
 *
 * @property Herramientas $hE
 * @property Subactividades $sACT
 */
class SactHeOcupan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sact_he_ocupan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['TH_ID', 'SACT_ID'], 'required'],
            [['TH_ID', 'SACT_ID', 'OC_CANTIDAD'], 'integer'],
            [['TH_ID'], 'exist', 'skipOnError' => true, 'targetClass' => TipoHerramienta::className(), 'targetAttribute' => ['TH_ID' => 'TH_ID']],
            [['SACT_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Subactividades::className(), 'targetAttribute' => ['SACT_ID' => 'SACT_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'OC_ID' => 'ID',
            'TH_ID' => 'Herramienta',
            'SACT_ID' => 'Subactividad',
            'OC_CANTIDAD' => 'Cantidad',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
   public function getTH()
   {
       return $this->hasOne(TipoHerramienta::className(), ['TH_ID' => 'TH_ID']);
   }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSACT()
    {
        return $this->hasOne(Subactividades::className(), ['SACT_ID' => 'SACT_ID']);
    }
}
