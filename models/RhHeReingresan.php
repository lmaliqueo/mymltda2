<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rh_he_reingresan".
 *
 * @property integer $REI_ID
 * @property integer $HE_ID
 * @property integer $RH_ID
 * @property integer $REI_CANTIDAD_SALIDA
 *
 * @property RetornoHerramientas $rH
 * @property Herramientas $hE
 */
class RhHeReingresan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rh_he_reingresan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['HE_ID', 'RH_ID'], 'required'],
            [['HE_ID', 'RH_ID', 'REI_CANTIDAD_SALIDA'], 'integer'],
            [['RH_ID'], 'exist', 'skipOnError' => true, 'targetClass' => RetornoHerramientas::className(), 'targetAttribute' => ['RH_ID' => 'RH_ID']],
            [['HE_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Herramientas::className(), 'targetAttribute' => ['HE_ID' => 'HE_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'REI_ID' => 'Rei  ID',
            'HE_ID' => 'He  ID',
            'RH_ID' => 'Rh  ID',
            'REI_CANTIDAD_SALIDA' => 'Rei  Cantidad  Salida',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRH()
    {
        return $this->hasOne(RetornoHerramientas::className(), ['RH_ID' => 'RH_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHE()
    {
        return $this->hasOne(Herramientas::className(), ['HE_ID' => 'HE_ID']);
    }
}
