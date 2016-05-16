<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "material_asignado".
 *
 * @property integer $MAS_ID
 * @property integer $MA_ID
 * @property integer $AS_ID
 * @property integer $MAS_CANTIDAD
 *
 * @property Materiales $mA
 * @property ActSactAsigna $aS
 */
class MaterialAsignado extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'material_asignado';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['MA_ID', 'AS_ID', 'MAS_CANTIDAD'], 'integer'],
            [['MA_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Materiales::className(), 'targetAttribute' => ['MA_ID' => 'MA_ID']],
            [['AS_ID'], 'exist', 'skipOnError' => true, 'targetClass' => ActSactAsigna::className(), 'targetAttribute' => ['AS_ID' => 'AS_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'MAS_ID' => 'Mas  ID',
            'MA_ID' => 'Ma  ID',
            'AS_ID' => 'As  ID',
            'MAS_CANTIDAD' => 'Mas  Cantidad',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMA()
    {
        return $this->hasOne(Materiales::className(), ['MA_ID' => 'MA_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAS()
    {
        return $this->hasOne(ActSactAsigna::className(), ['AS_ID' => 'AS_ID']);
    }
}
