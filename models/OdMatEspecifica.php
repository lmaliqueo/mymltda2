<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "od_mat_especifica".
 *
 * @property integer $ESP_ID
 * @property integer $OD_ID
 * @property integer $AL_ID
 * @property integer $ESP_CANTIDAD_DESPACHO
 *
 * @property OrdenDespacho $oD
 * @property BoMatAlmacena $aL
 */
class OdMatEspecifica extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'od_mat_especifica';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['OD_ID', 'AL_ID'], 'required'],
            [['OD_ID', 'AL_ID', 'ESP_CANTIDAD_DESPACHO'], 'integer'],
            [['OD_ID'], 'exist', 'skipOnError' => true, 'targetClass' => OrdenDespacho::className(), 'targetAttribute' => ['OD_ID' => 'OD_ID']],
            [['AL_ID'], 'exist', 'skipOnError' => true, 'targetClass' => BoMatAlmacena::className(), 'targetAttribute' => ['AL_ID' => 'AL_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ESP_ID' => 'Esp  ID',
            'OD_ID' => 'Od  ID',
            'AL_ID' => 'Al  ID',
            'ESP_CANTIDAD_DESPACHO' => 'Esp  Cantidad  Despacho',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOD()
    {
        return $this->hasOne(OrdenDespacho::className(), ['OD_ID' => 'OD_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAL()
    {
        return $this->hasOne(BoMatAlmacena::className(), ['AL_ID' => 'AL_ID']);
    }
}
