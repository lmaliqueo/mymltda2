<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "herramientas".
 *
 * @property integer $HE_ID
 * @property integer $BO_ID
 * @property string $HE_NOMBRE
 * @property integer $HE_CANT
 * @property integer $HE_COSTOUNIDAD
 *
 * @property HerramientaAsignado[] $herramientaAsignados 
 * @property HerramientaTiene[] $herramientaTienes
 * @property Bodegas $bO
 * @property TipoHerramienta $tH
 * @property RhHeReingresan[] $rhHeReingresans
 * @property DhHeRetiran[] $dhHeRetirans
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
           [['BO_ID', 'TH_ID'], 'required'],
           [['BO_ID', 'TH_ID', 'HE_CANT', 'HE_COSTOUNIDAD'], 'integer'],
           [['HE_NOMBRE'], 'string', 'max' => 50],
           [['BO_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Bodegas::className(), 'targetAttribute' => ['BO_ID' => 'BO_ID']],
           [['TH_ID'], 'exist', 'skipOnError' => true, 'targetClass' => TipoHerramienta::className(), 'targetAttribute' => ['TH_ID' => 'TH_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'HE_ID' => 'ID',
            'BO_ID' => 'Bodega',
            'TH_ID' => 'Tipo de Herramienta',
            'HE_NOMBRE' => 'Descripción',
            'HE_CANT' => 'Cantidad',
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


    public function getHerramientaTienes()
    {
        return $this->hasMany(HerramientaTiene::className(), ['HE_ID' => 'HE_ID']);
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
