<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "asigna_tiene".
 *
 * @property integer $AT_ID
 * @property integer $AS_ID
 * @property integer $EP_ID
 * @property integer $AT_CANTIDAD
 * @property integer $AT_COSTO_EP
 *
 * @property ActSactAsigna $aS
 * @property EstadoPago $eP
 */
class AsignaTiene extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'asigna_tiene';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['AS_ID', 'EP_ID'], 'required'],
            [['AS_ID', 'EP_ID', 'AT_CANTIDAD', 'AT_COSTO_EP'], 'integer'],
            [['AS_ID'], 'exist', 'skipOnError' => true, 'targetClass' => ActSactAsigna::className(), 'targetAttribute' => ['AS_ID' => 'AS_ID']],
            [['EP_ID'], 'exist', 'skipOnError' => true, 'targetClass' => EstadoPago::className(), 'targetAttribute' => ['EP_ID' => 'EP_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'AT_ID' => 'ID',
            'AS_ID' => 'Sub-ACtividad',
            'EP_ID' => 'Estado de Pago',
            'AT_CANTIDAD' => 'Cantidad Anterior',
            'AT_COSTO_EP' => 'Costo Anterior',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAS()
    {
        return $this->hasOne(ActSactAsigna::className(), ['AS_ID' => 'AS_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEP()
    {
        return $this->hasOne(EstadoPago::className(), ['EP_ID' => 'EP_ID']);
    }
}
