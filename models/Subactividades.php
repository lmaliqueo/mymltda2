<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "subactividades".
 *
 * @property integer $SACT_ID
 * @property string $SACT_NOMBRE
 * @property string $SACT_DESCRIPCION
 * @property integer $SACT_COSTO
 *
 * @property ActSactAsigna[] $actSactAsignas
 * @property SactHeOcupan[] $sactHeOcupans
 * @property SactMatConsume[] $sactMatConsumes
 */
class Subactividades extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'subactividades';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['SACT_DESCRIPCION'], 'string'],
            [['SACT_NOMBRE'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'SACT_ID' => 'ID',
            'SACT_NOMBRE' => 'Nombre',
            'SACT_DESCRIPCION' => 'Descripción',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActSactAsignas()
    {
        return $this->hasMany(ActSactAsigna::className(), ['SACT_ID' => 'SACT_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSactHeOcupans()
    {
        return $this->hasMany(SactHeOcupan::className(), ['SACT_ID' => 'SACT_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSactMatConsumes()
    {
        return $this->hasMany(SactMatConsume::className(), ['SACT_ID' => 'SACT_ID']);
    }
    public function getSactObRequieres() 
    { 
        return $this->hasMany(SactObRequiere::className(), ['SACT_ID' => 'SACT_ID']); 
    } 
}
