<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "herramientas".
 *
 * @property string $HE_ID
 * @property integer $PROV_ID 
 * @property integer $BO_ID
 * @property integer $TH_ID
 * @property string $HE_DESCRIPCION
 * @property string $HE_ESTADO
 * @property integer $HE_COSTOUNIDAD
 *
 * @property DhHeRetiran[] $dhHeRetirans
 * @property HerramientaAsignado[] $herramientaAsignados 
 * @property Bodegas $bO
 * @property Proveedor $pROV 
 * @property TipoHerramienta $tH
 * @property RhHeReingresan[] $rhHeReingresans
 * @property SpreHeSolicita[] $spreHeSolicitas
 */
class Herramientas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'herramientas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['HE_ID', 'PROV_ID', 'BO_ID', 'TH_ID'], 'required'],
            [['PROV_ID', 'BO_ID', 'TH_ID', 'HE_COSTOUNIDAD'], 'integer'],
            [['HE_ID'], 'string', 'max' => 10],
            [['HE_DESCRIPCION'], 'string', 'max' => 50],
            [['HE_ESTADO'], 'string', 'max' => 20],
            [['BO_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Bodegas::className(), 'targetAttribute' => ['BO_ID' => 'BO_ID']],
            [['PROV_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Proveedor::className(), 'targetAttribute' => ['PROV_ID' => 'PROV_ID']], 
            [['TH_ID'], 'exist', 'skipOnError' => true, 'targetClass' => TipoHerramienta::className(), 'targetAttribute' => ['TH_ID' => 'TH_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'HE_ID' => 'Código',
            'PROV_ID' => 'Proveedor',
            'BO_ID' => 'Bodega',
            'TH_ID' => 'Tipo',
            'HE_DESCRIPCION' => 'Descripción',
            'HE_ESTADO' => 'Estado',
            'HE_COSTOUNIDAD' => 'Costo Asociado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */

    public function getHerramientaAsignados() 
    { 
       return $this->hasMany(HerramientaAsignado::className(), ['HE_ID' => 'HE_ID']); 
    }

    /**
     * @return \yii\db\ActiveQuery
     */

    public function getPROV()
    {
        return $this->hasOne(Proveedor::className(), ['PROV_ID' => 'PROV_ID']);
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
    
    public function getTH()
    {
        return $this->hasOne(TipoHerramienta::className(), ['TH_ID' => 'TH_ID']);
    }

    /** 
     * @return \yii\db\ActiveQuery 
     */ 
    public function getRhHeReingresans() 
    { 
        return $this->hasMany(RhHeReingresan::className(), ['HE_ID' => 'HE_ID']); 
    } 

    /** 
     * @return \yii\db\ActiveQuery 
     */ 
    public function getDhHeRetirans() 
    { 
        return $this->hasMany(DhHeRetiran::className(), ['HE_ID' => 'HE_ID']); 
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSpreHeSolicitas()
    {
        return $this->hasMany(SpreHeSolicita::className(), ['HE_ID' => 'HE_ID']);
    }
}
