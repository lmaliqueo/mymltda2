<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "orden_trabajo".
 *
 * @property integer $OT_ID
 * @property integer $PRO_ID
 * @property string $OT_NOMBRE
 * @property string $OT_TIPO
 * @property string $OT_FECHA_INICIO
 * @property string $OT_FECHA_TERMINO
 * @property string $OT_ESTADO
 * @property integer $OT_COSTO_TOTAL
 * @property string $OT_INFORME
 *
 * @property Actividades[] $actividades
 * @property BoMatAlmacena[] $boMatAlmacenas 
 * @property GastosGenerales[] $gastosGenerales 
 * @property Proyecto $pRO
 * @property ReportesAvances[] $reportesAvances
 * @property StockMateriales[] $stockMateriales
 */
class OrdenTrabajo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'orden_trabajo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PRO_ID'], 'required'],
            [['PRO_ID', 'OT_COSTO_TOTAL'], 'integer'],
            [['OT_FECHA_INICIO', 'OT_FECHA_TERMINO'], 'safe'],
            [['OT_NOMBRE'], 'string', 'max' => 50],
            [['OT_TIPO', 'OT_ESTADO'], 'string', 'max' => 20],
            [['OT_INFORME'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'OT_ID' => 'ID',
            'PRO_ID' => 'Proyecto',
            'OT_NOMBRE' => 'Nombre',
            'OT_TIPO' => 'Ot  Tipo',
            'OT_FECHA_INICIO' => 'Fecha Inicio',
            'OT_FECHA_TERMINO' => 'Fecha Término',
            'OT_ESTADO' => 'Estado',
            'OT_COSTO_TOTAL' => 'Costo Total',
            'OT_INFORME' => 'Informe',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActividades()
    {
        return $this->hasMany(Actividades::className(), ['OT_ID' => 'OT_ID']);
    }

    /** 
     * @return \yii\db\ActiveQuery 
     */ 
    public function getBoMatAlmacenas() 
    { 
        return $this->hasMany(BoMatAlmacena::className(), ['OT_ID' => 'OT_ID']); 
    } 
 
    /** 
     * @return \yii\db\ActiveQuery 
     */ 
    public function getGastosGenerales() 
    { 
        return $this->hasMany(GastosGenerales::className(), ['OT_ID' => 'OT_ID']); 
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPRO()
    {
        return $this->hasOne(Proyecto::className(), ['PRO_ID' => 'PRO_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReportesAvances()
    {
        return $this->hasMany(ReportesAvances::className(), ['OT_ID' => 'OT_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStockMateriales()
    {
        return $this->hasMany(StockMateriales::className(), ['OT_ID' => 'OT_ID']);
    }
}
