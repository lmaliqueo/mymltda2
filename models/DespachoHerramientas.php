<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "despacho_herramientas".
 *
 * @property integer $DH_ID
 * @property integer $OT_ID
 * @property string $DH_FECHA_SALIDA
 * @property string $DH_ESTADO
 *
 * @property OrdenTrabajo $oT
 * @property DhHeRetiran[] $dhHeRetirans
 */
class DespachoHerramientas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'despacho_herramientas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['OT_ID'], 'required'],
            [['OT_ID'], 'integer'],
            [['DH_FECHA_SALIDA'], 'safe'],
            [['DH_ESTADO'], 'string', 'max' => 20],
            [['OT_ID'], 'exist', 'skipOnError' => true, 'targetClass' => OrdenTrabajo::className(), 'targetAttribute' => ['OT_ID' => 'OT_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'DH_ID' => 'Dh  ID',
            'OT_ID' => 'Ot  ID',
            'DH_FECHA_SALIDA' => 'Dh  Fecha  Salida',
            'DH_ESTADO' => 'Dh  Estado',
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
    public function getDhHeRetirans()
    {
        return $this->hasMany(DhHeRetiran::className(), ['DH_ID' => 'DH_ID']);
    }
}
