<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bo_mat_almacena".
 *
 * @property integer $AL_ID
 * @property integer $BO_ID
 * @property integer $MA_ID
 * @property integer $OT_ID
 * @property integer $AL_CANTIDAD
 * @property integer $AL_CANTIDAD_DESPACHO
 *
 * @property Bodegas $bO
 * @property Materiales $mA
 * @property OrdenTrabajo $oT 
 * @property OdMatEspecifica[] $odMatEspecificas
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
            [['MA_ID', 'OT_ID'], 'required'],
            [['BO_ID', 'MA_ID', 'OT_ID', 'AL_CANTIDAD', 'AL_CANTIDAD_DESPACHO'], 'integer'],
            [['BO_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Bodegas::className(), 'targetAttribute' => ['BO_ID' => 'BO_ID']],
            [['MA_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Materiales::className(), 'targetAttribute' => ['MA_ID' => 'MA_ID']],
            [['OT_ID'], 'exist', 'skipOnError' => true, 'targetClass' => OrdenTrabajo::className(), 'targetAttribute' => ['OT_ID' => 'OT_ID']],
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
            'OT_ID' => 'Orden de Trabajo',
            'AL_CANTIDAD' => 'Cantidad',
            'AL_CANTIDAD_DESPACHO' => 'Cantidad Despacho',
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

    /** 
     * @return \yii\db\ActiveQuery 
     */ 
    public function getOT() 
    { 
        return $this->hasOne(OrdenTrabajo::className(), ['OT_ID' => 'OT_ID']); 
    }
    
    /** 
     * @return \yii\db\ActiveQuery 
     */ 
    public function getOdMatEspecificas() 
    { 
        return $this->hasMany(OdMatEspecifica::className(), ['AL_ID' => 'AL_ID']); 
    } 

}
