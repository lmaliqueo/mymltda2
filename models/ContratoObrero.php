<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "contrato_obrero".
 *
 * @property integer $COO_ID
 * @property string $PE_RUT
 * @property integer $PRO_ID
 * @property integer $TOB_ID
 * @property string $COO_FECHA
 * @property string $COO_ESTADO
 * @property integer $COO_HORAS
 *
 * @property TipoObrero $tOB
 * @property Proyecto $pRO
 * @property Persona $pERUT
 * @property SueldoObrero[] $sueldoObreros
 */
class ContratoObrero extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'contrato_obrero';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PE_RUT', 'PRO_ID', 'TOB_ID'], 'required'],
            [['PRO_ID', 'TOB_ID', 'COO_HORAS'], 'integer'],
            [['COO_FECHA'], 'safe'],
            [['PE_RUT'], 'string', 'max' => 12],
            [['COO_ESTADO'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'COO_ID' => 'ID',
            'PE_RUT' => 'Obrero',
            'PRO_ID' => 'Proyecto',
            'TOB_ID' => 'Tipo Obrero',
            'COO_FECHA' => 'Fecha',
            'COO_ESTADO' => 'Estado',
            'COO_HORAS' => 'Horas',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTOB()
    {
        return $this->hasOne(TipoObrero::className(), ['TOB_ID' => 'TOB_ID']);
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
    public function getPERUT()
    {
        return $this->hasOne(Persona::className(), ['PE_RUT' => 'PE_RUT']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSueldoObreros()
    {
        return $this->hasMany(SueldoObrero::className(), ['COO_ID' => 'COO_ID']);
    }
}
