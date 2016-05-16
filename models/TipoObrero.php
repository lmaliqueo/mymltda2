<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tipo_obrero".
 *
 * @property integer $TOB_ID
 * @property string $TOB_NOMBRE
 * @property string $TOB_DESCRIPCION
 *
 * @property ContratoObrero[] $contratoObreros
 */
class TipoObrero extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tipo_obrero';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['TOB_NOMBRE'], 'string', 'max' => 30],
            [['TOB_DESCRIPCION'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'TOB_ID' => 'ID',
            'TOB_NOMBRE' => 'Tipo Obrero',
            'TOB_DESCRIPCION' => 'Descripción',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContratoObreros()
    {
        return $this->hasMany(ContratoObrero::className(), ['TOB_ID' => 'TOB_ID']);
    }
    
    public function getSactObRequieres() 
    { 
        return $this->hasMany(SactObRequiere::className(), ['TOB_ID' => 'TOB_ID']); 
    } 
}
