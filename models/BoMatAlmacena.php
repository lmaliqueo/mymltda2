<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bo_mat_almacena".
 *
 * @property integer $AL_ID
 * @property integer $BO_ID
 * @property integer $MA_ID
 * @property integer $ALM_CANTMATERIALES
 *
 * @property Bodegas $bO
 * @property Materiales $mA
 */
class BoMatAlmacena extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bo_mat_almacena';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['BO_ID', 'MA_ID'], 'required'],
            [['BO_ID', 'MA_ID', 'AL_CANTMATERIALES'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'AL_ID' => 'ID',
            'BO_ID' => 'Bodega',
            'MA_ID' => 'Material',
            'AL_CANTMATERIALES' => 'Cantidad Material',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBO()
    {
        return $this->hasOne(Bodegas::className(), ['BO_ID' => 'BO_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMA()
    {
        return $this->hasOne(Materiales::className(), ['MA_ID' => 'MA_ID']);
    }
}
