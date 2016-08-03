<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "herramienta_asignado".
 *
 * @property integer $HAS_ID
 * @property string $HE_ID
 * @property integer $AS_ID
 *
 * @property Herramientas $hE
 * @property ActSactAsigna $aS
 */
class HerramientaAsignado extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'herramienta_asignado';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['HE_ID', 'AS_ID'], 'required'],
            [['AS_ID'], 'integer'],
            [['HE_ID'], 'string', 'max' => 10],
            [['HE_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Herramientas::className(), 'targetAttribute' => ['HE_ID' => 'HE_ID']],
            [['AS_ID'], 'exist', 'skipOnError' => true, 'targetClass' => ActSactAsigna::className(), 'targetAttribute' => ['AS_ID' => 'AS_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'HAS_ID' => 'Has  ID',
            'HE_ID' => 'He  ID',
            'AS_ID' => 'As  ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHE()
    {
        return $this->hasOne(Herramientas::className(), ['HE_ID' => 'HE_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAS()
    {
        return $this->hasOne(ActSactAsigna::className(), ['AS_ID' => 'AS_ID']);
    }
}

