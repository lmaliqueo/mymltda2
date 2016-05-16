<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "actividades".
 *
 * @property integer $AC_ID
 * @property integer $OT_ID
 * @property string $AC_NOMBRE
 * @property string $AC_FECHA_INICIO
 * @property string $AC_FECHA_TERMINO
 * @property integer $AC_COSTO_TOTAL
 * @property string $AC_ESTADO
 *
 * @property ActSactAsigna[] $actSactAsignas
 * @property OrdenTrabajo $oT
 * @property ManodeobraTrabajan[] $manodeobraTrabajans
 */
class Actividades extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'actividades';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['OT_ID'], 'required'],
            [['OT_ID', 'AC_COSTO_TOTAL'], 'integer'],
            [['AC_FECHA_INICIO', 'AC_FECHA_TERMINO'], 'safe'],
            [['AC_NOMBRE'], 'string', 'max' => 50],
            [['AC_ESTADO'], 'string', 'max' => 20],
            [['OT_ID'], 'exist', 'skipOnError' => true, 'targetClass' => OrdenTrabajo::className(), 'targetAttribute' => ['OT_ID' => 'OT_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'AC_ID' => 'ID',
            'OT_ID' => 'Orden de Trabajo',
            'AC_NOMBRE' => 'Nombre',
            'AC_FECHA_INICIO' => 'Fecha Inicio',
            'AC_FECHA_TERMINO' => 'Fecha Término',
            'AC_COSTO_TOTAL' => 'Costo Total',
            'AC_ESTADO' => 'Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActSactAsignas()
    {
        return $this->hasMany(ActSactAsigna::className(), ['AC_ID' => 'AC_ID']);
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
    public function getManodeobraTrabajans()
    {
        return $this->hasMany(ManodeobraTrabajan::className(), ['AC_ID' => 'AC_ID']);
    }
}
