<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "act_sact_asigna".
 *
 * @property integer $AS_ID
 * @property integer $AC_ID
 * @property integer $SACT_ID
 * @property integer $AS_CANTIDAD
 * @property integer $AS_COSTOTOTAL
 * @property integer $AS_CANTIDADACTUAL
 * @property integer $AS_COSTOACTUAL
 *
 * @property Actividades $aC
 * @property Subactividades $sACT
 * @property AsignaAcumula[] $asignaAcumulas 
 * @property AsignaTiene[] $asignaTienes
 * @property HerramientaAsignado[] $herramientaAsignados 
 * @property MaterialAsignado[] $materialAsignados 
 */
class ActSactAsigna extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'act_sact_asigna';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['AC_ID', 'SACT_ID'], 'required'],
            [['AC_ID', 'SACT_ID', 'AS_CANTIDAD', 'AS_COSTOTOTAL', 'AS_CANTIDADACTUAL', 'AS_COSTOACTUAL'], 'integer'],
            [['AC_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Actividades::className(), 'targetAttribute' => ['AC_ID' => 'AC_ID']],
            [['SACT_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Subactividades::className(), 'targetAttribute' => ['SACT_ID' => 'SACT_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'AS_ID' => 'ID',
            'AC_ID' => 'Actividad',
            'SACT_ID' => 'Sub-Actividad',
            'AS_CANTIDAD' => 'Cantidad',
            'AS_COSTOTOTAL' => 'Costo Total',
            'AS_CANTIDADACTUAL' => 'Cantidad Actual',
            'AS_COSTOACTUAL' => 'Costo Actual',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAC()
    {
        return $this->hasOne(Actividades::className(), ['AC_ID' => 'AC_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSACT()
    {
        return $this->hasOne(Subactividades::className(), ['SACT_ID' => 'SACT_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAsignaTienes()
    {
        return $this->hasMany(AsignaTiene::className(), ['AS_ID' => 'AS_ID']);
    }


    /** 
     * @return \yii\db\ActiveQuery 
     */ 

    public function getAsignaAcumulas() 
    { 
        return $this->hasMany(AsignaAcumula::className(), ['AS_ID' => 'AS_ID']); 
    } 
 
    /** 
     * @return \yii\db\ActiveQuery 
     */ 

    
    public function getHerramientaAsignados() 
    { 
       return $this->hasMany(HerramientaAsignado::className(), ['AS_ID' => 'AS_ID']); 
    } 
 
    /** 
     * @return \yii\db\ActiveQuery 
     */ 

    public function getMaterialAsignados() 
    { 
        return $this->hasMany(MaterialAsignado::className(), ['AS_ID' => 'AS_ID']); 
    } 
}
