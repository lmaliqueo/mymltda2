<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "orden_despacho".
 *
 * @property integer $OD_ID
 * @property integer $OD_NUMERO_ORDEN
 * @property string $OD_FECHA_EMISION
 * @property string $OD_FECHA_RECEPCION
 * @property string $OD_DESCRIPCION
 *
 * @property OdMatEspecifica[] $odMatEspecificas
 */
class OrdenDespacho extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'orden_despacho';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['OD_NUMERO_ORDEN'], 'integer'],
            [['OD_FECHA_EMISION', 'OD_FECHA_RECEPCION'], 'safe'],
            [['OD_DESCRIPCION'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'OD_ID' => 'Od  ID',
            'OD_NUMERO_ORDEN' => 'Od  Numero  Orden',
            'OD_FECHA_EMISION' => 'Od  Fecha  Emision',
            'OD_FECHA_RECEPCION' => 'Od  Fecha  Recepcion',
            'OD_DESCRIPCION' => 'Od  Descripcion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOdMatEspecificas()
    {
        return $this->hasMany(OdMatEspecifica::className(), ['OD_ID' => 'OD_ID']);
    }
}
