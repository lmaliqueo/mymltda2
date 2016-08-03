<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "reportes_avances".
 *
 * @property integer $RA_ID
 * @property integer $OT_ID
 * @property string $RA_TITULO
 * @property string $RA_FECHA
 * @property string $RA_DESCRIPCION
 *
 * @property AsignaAcumula[] $asignaAcumulas 
 * @property OrdenTrabajo $oT
 */
class ReportesAvances extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reportes_avances';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['OT_ID', 'RA_TITULO'], 'required'],
            [['OT_ID'], 'integer'],
            [['RA_FECHA'], 'safe'],
            [['RA_DESCRIPCION'], 'string'],
            [['RA_TITULO'], 'string', 'max' => 50],
            [['OT_ID'], 'exist', 'skipOnError' => true, 'targetClass' => OrdenTrabajo::className(), 'targetAttribute' => ['OT_ID' => 'OT_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'RA_ID' => 'ID',
            'OT_ID' => 'Orden de Trabajo',
            'RA_TITULO' => 'Título',
            'RA_FECHA' => 'Fecha',
            'RA_DESCRIPCION' => 'Descripción',
        ];
    }

 
    /** 
     * @return \yii\db\ActiveQuery 
     */ 
    public function getAsignaAcumulas() 
    { 
        return $this->hasMany(AsignaAcumula::className(), ['RA_ID' => 'RA_ID']); 
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOT()
    {
        return $this->hasOne(OrdenTrabajo::className(), ['OT_ID' => 'OT_ID']);
    }
}
