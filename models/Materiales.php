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
 * @property MatProvAdquirido[] $matProvAdquiridos
 * @property SactMatConsume[] $sactMatConsumes
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
            [['TMA_ID'], 'required'],
            [['TMA_ID', 'MA_CANTIDADTOTAL', 'MA_MEDIDA', 'MA_COSTOUNIDAD'], 'integer'],
            [['MA_NOMBRE', 'MA_UNIDAD'], 'string', 'max' => 50],
            [['MA_TIPOMATERIALES'], 'string', 'max' => 20],
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
            'MA_CANTIDADTOTAL' => 'Cantidad Total',
            'MA_UNIDAD' => 'Unidad',
            'MA_MEDIDA' => 'Medida',
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
    public function getMatProvAdquiridos()
    {
        return $this->hasMany(MatProvAdquirido::className(), ['MA_ID' => 'MA_ID']);
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
