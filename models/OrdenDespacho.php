<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "orden_despacho".
 *
 * @property integer $OD_ID
 * @property integer $OT_ID 
 * @property integer $OD_NUMERO_ORDEN
 * @property string $OD_FECHA_EMISION
 * @property string $OD_FECHA_RECEPCION
 * @property string $OD_DESCRIPCION
 * @property string $OD_ESTADO 
 *
 * @property OdMatEspecifica[] $odMatEspecificas
 * @property OrdenTrabajo $oT 
 */
class OrdenDespacho extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'orden_despacho';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['OT_ID'], 'required'],
            [['OT_ID', 'OD_NUMERO_ORDEN'], 'integer'],
            [['OD_FECHA_EMISION', 'OD_FECHA_RECEPCION'], 'safe'],
            [['OD_ESTADO'], 'string', 'max' => 20],
            [['OD_DESCRIPCION'], 'string'],
            [['OT_ID'], 'exist', 'skipOnError' => true, 'targetClass' => OrdenTrabajo::className(), 'targetAttribute' => ['OT_ID' => 'OT_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'OD_ID' => 'Od  ID',
            'OT_ID' => 'Orden de Trabajo',
            'OD_NUMERO_ORDEN' => 'Od  Numero  Orden',
            'OD_FECHA_EMISION' => 'Od  Fecha  Emision',
            'OD_FECHA_RECEPCION' => 'Od  Fecha  Recepcion',
            'OD_DESCRIPCION' => 'Od  Descripcion',
            'OD_ESTADO' => 'Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOdMatEspecificas()
    {
        return $this->hasMany(OdMatEspecifica::className(), ['OD_ID' => 'OD_ID']);
    }

    /** 
    * @return \yii\db\ActiveQuery 
    */ 
    public function getOT() 
    { 
       return $this->hasOne(OrdenTrabajo::className(), ['OT_ID' => 'OT_ID']); 
    } 
}
