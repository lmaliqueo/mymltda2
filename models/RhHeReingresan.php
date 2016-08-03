<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rh_he_reingresan".
 *
 * @property integer $REI_ID
 * @property string $HE_ID
 * @property integer $RH_ID
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
            [['RH_ID'], 'integer'],
            [['HE_ID'], 'string', 'max' => 10],
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
            'REI_ID' => 'ID',
            'HE_ID' => 'Herramientas',
            'RH_ID' => 'Devolución',
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
