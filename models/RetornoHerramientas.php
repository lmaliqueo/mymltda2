<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "retorno_herramientas".
 *
 * @property integer $RH_ID
 * @property integer $OT_ID
 * @property string $RH_FECHA_RETORNO
 * @property string $RH_DESCRIPCION
 * @property string $RH_ESTADO
 *
 * @property OrdenTrabajo $oT
 * @property RhHeReingresan[] $rhHeReingresans
 */
class RetornoHerramientas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'retorno_herramientas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['OT_ID'], 'required'],
            [['OT_ID'], 'integer'],
            [['RH_FECHA_RETORNO'], 'safe'],
            [['RH_DESCRIPCION'], 'string'],
            [['RH_ESTADO'], 'string', 'max' => 20],
            [['OT_ID'], 'exist', 'skipOnError' => true, 'targetClass' => OrdenTrabajo::className(), 'targetAttribute' => ['OT_ID' => 'OT_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'RH_ID' => 'Rh  ID',
            'OT_ID' => 'Ot  ID',
            'RH_FECHA_RETORNO' => 'Rh  Fecha  Retorno',
            'RH_DESCRIPCION' => 'Rh  Descripcion',
            'RH_ESTADO' => 'Rh  Estado',
        ];
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
    public function getRhHeReingresans()
    {
        return $this->hasMany(RhHeReingresan::className(), ['RH_ID' => 'RH_ID']);
    }
}
