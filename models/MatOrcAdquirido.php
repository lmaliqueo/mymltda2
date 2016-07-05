<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "mat_orc_adquirido".
 *
 * @property integer $AD_ID
 * @property integer $ORC_ID
 * @property integer $MA_ID
 * @property integer $BO_ID
 * @property integer $SM_ID
 * @property integer $AD_CANTIDAD
 * @property integer $AD_COSTO_TOTAL
 * @property string $AD_FECHA
 *
 * @property OrdenCompra $oRC
 * @property Materiales $mA
 * @property StockMateriales $sM
 * @property Bodegas $bO
 */
class MatOrcAdquirido extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mat_orc_adquirido';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['ORC_ID', 'MA_ID', 'SM_ID'], 'required'],
            [['ORC_ID', 'MA_ID', 'BO_ID', 'SM_ID', 'AD_CANTIDAD', 'AD_COSTO_TOTAL'], 'integer'],
            [['AD_FECHA'], 'safe'],
            [['ORC_ID'], 'exist', 'skipOnError' => true, 'targetClass' => OrdenCompra::className(), 'targetAttribute' => ['ORC_ID' => 'ORC_ID']],
            [['MA_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Materiales::className(), 'targetAttribute' => ['MA_ID' => 'MA_ID']],
            [['SM_ID'], 'exist', 'skipOnError' => true, 'targetClass' => StockMateriales::className(), 'targetAttribute' => ['SM_ID' => 'SM_ID']],
            [['BO_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Bodegas::className(), 'targetAttribute' => ['BO_ID' => 'BO_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'AD_ID' => 'ID',
            'ORC_ID' => 'Orden de Compra',
            'MA_ID' => 'Material',
            'BO_ID' => 'Bodega',
            'SM_ID' => 'Stock',
            'AD_CANTIDAD' => 'Cantidad',
            'AD_COSTO_TOTAL' => 'Costo Total',
            'AD_FECHA' => 'Fecha',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getORC()
    {
        return $this->hasOne(OrdenCompra::className(), ['ORC_ID' => 'ORC_ID']);
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
    public function getSM()
    {
        return $this->hasOne(StockMateriales::className(), ['SM_ID' => 'SM_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBO()
    {
        return $this->hasOne(Bodegas::className(), ['BO_ID' => 'BO_ID']);
    }
}
