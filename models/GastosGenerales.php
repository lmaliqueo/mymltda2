<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "gastos_generales".
 *
 * @property integer $GG_ID
 * @property integer $OT_ID
 * @property string $GG_TIPO
 * @property string $GG_DESCRIPCION
 * @property integer $GG_COSTO
 *
 * @property Proyecto $oT
 */
class GastosGenerales extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gastos_generales';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['OT_ID'], 'required'],
            [['OT_ID', 'GG_COSTO'], 'integer'],
            [['GG_TIPO'], 'string', 'max' => 20],
            [['GG_DESCRIPCION'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'GG_ID' => 'ID',
            'OT_ID' => 'Orden de Trabajo',
            'GG_TIPO' => 'Tipo de Gasto',
            'GG_DESCRIPCION' => 'Descripcion',
            'GG_COSTO' => 'Costo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOT()
    {
        return $this->hasOne(OrdenTrabajo::className(), ['OT_ID' => 'OT_ID']);
    }
}
