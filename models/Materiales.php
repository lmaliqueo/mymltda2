<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "materiales".
 *
 * @property integer $MA_ID
 * @property string $MA_NOMBRE
 * @property integer $MA_CANTIDADTOTAL
 * @property string $MA_UNIDAD
 * @property integer $MA_MEDIDA
 * @property string $MA_TIPOMATERIALES
 * @property integer $MA_COSTOUNIDAD
 *
 * @property BoMatAlmacena[] $boMatAlmacenas
 * @property MatOrcAdquirido[] $matOrcAdquiridos
 * @property MaterialAsignado[] $materialAsignados 
 * @property TipoMaterial $tMA 
 * @property StockMateriales[] $stockMateriales
 */
class Materiales extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'materiales';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['TMA_ID','MA_ID'], 'required'],
            [['TMA_ID', 'MA_COSTOUNIDAD'], 'integer'],
            [['MA_ID'], 'string', 'max' => 10],
            [['MA_NOMBRE', 'MA_UNIDAD'], 'string', 'max' => 50],
            [['TMA_ID'], 'exist', 'skipOnError' => true, 'targetClass' => TipoMaterial::className(), 'targetAttribute' => ['TMA_ID' => 'TMA_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'MA_ID' => 'ID',
            'TMA_ID' => 'Tipo de Material',
            'MA_NOMBRE' => 'Descripción',
            'MA_UNIDAD' => 'Unidad',
            'MA_COSTOUNIDAD' => 'Costo por Unidad',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBoMatAlmacenas()
    {
        return $this->hasMany(BoMatAlmacena::className(), ['MA_ID' => 'MA_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMatOrcAdquiridos()
    {
        return $this->hasMany(MatOrcAdquirido::className(), ['MA_ID' => 'MA_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMaterialAsignados()
    {
        return $this->hasMany(MaterialAsignado::className(), ['MA_ID' => 'MA_ID']);
    }

   /** 
    * @return \yii\db\ActiveQuery 
    */ 

    public function getTMA() 
    { 
        return $this->hasOne(TipoMaterial::className(), ['TMA_ID' => 'TMA_ID']); 
    } 
 
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockMateriales()
    {
        return $this->hasMany(StockMateriales::className(), ['MA_ID' => 'MA_ID']);
    }
}
