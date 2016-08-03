<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "asigna_acumula".
 *
 * @property integer $AA_ID
 * @property integer $AS_ID
 * @property integer $RA_ID
 * @property integer $AA_CANTIDAD
 *
 * @property ActSactAsigna $aS
 * @property ReportesAvances $rA
 */
class AsignaAcumula extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'asigna_acumula';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['AS_ID', 'RA_ID'], 'required'],
            [['AS_ID', 'RA_ID', 'AA_CANTIDAD'], 'integer'],
            [['AS_ID'], 'exist', 'skipOnError' => true, 'targetClass' => ActSactAsigna::className(), 'targetAttribute' => ['AS_ID' => 'AS_ID']],
            [['RA_ID'], 'exist', 'skipOnError' => true, 'targetClass' => ReportesAvances::className(), 'targetAttribute' => ['RA_ID' => 'RA_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'AA_ID' => 'Aa  ID',
            'AS_ID' => 'As  ID',
            'RA_ID' => 'Ra  ID',
            'AA_CANTIDAD' => 'Aa  Cantidad',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAS()
    {
        return $this->hasOne(ActSactAsigna::className(), ['AS_ID' => 'AS_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRA()
    {
        return $this->hasOne(ReportesAvances::className(), ['RA_ID' => 'RA_ID']);
    }
}
