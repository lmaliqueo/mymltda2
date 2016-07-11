<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "stock_materiales".
 *
 * @property integer $SM_ID
 * @property integer $OT_ID
 * @property integer $MA_ID
 * @property integer $SM_CANTIDAD
 * @property string $SM_ESTADO
 *
 * @property CantidadUtilizada[] $cantidadUtilizadas
 * @property MatOrcAdquirido[] $matOrcAdquiridos 
 * @property PedidoAdjunta[] $pedidoAdjuntas
 * @property OrdenTrabajo $oT
 * @property Materiales $mA
 */
class StockMateriales extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'stock_materiales';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['OT_ID', 'MA_ID'], 'required'],
            [['OT_ID', 'MA_ID', 'SM_CANTIDAD'], 'integer'],
            [['SM_ESTADO'], 'string', 'max' => 20],
            [['OT_ID'], 'exist', 'skipOnError' => true, 'targetClass' => OrdenTrabajo::className(), 'targetAttribute' => ['OT_ID' => 'OT_ID']],
            [['MA_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Materiales::className(), 'targetAttribute' => ['MA_ID' => 'MA_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'SM_ID' => 'ID',
            'OT_ID' => 'Orden de Trabajo',
            'MA_ID' => 'Material',
            'SM_CANTIDAD' => 'Cantidad',
            'SM_ESTADO' => 'Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCantidadUtilizadas()
    {
        return $this->hasMany(CantidadUtilizada::className(), ['SM_ID' => 'SM_ID']);
    }

    /** 
     * @return \yii\db\ActiveQuery 
     */ 
    public function getMatOrcAdquiridos() 
    { 
        return $this->hasMany(MatOrcAdquirido::className(), ['SM_ID' => 'SM_ID']); 
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPedidoAdjuntas()
    {
        return $this->hasMany(PedidoAdjunta::className(), ['SM_ID' => 'SM_ID']);
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
    public function getMA()
    {
        return $this->hasOne(Materiales::className(), ['MA_ID' => 'MA_ID']);
    }
}
