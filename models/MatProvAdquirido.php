<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "mat_prov_adquirido".
 *
 * @property integer $AD_ID
 * @property integer $PROV_ID
 * @property integer $MA_ID
 * @property integer $TM_ID
 *
 * @property Proveedor $pROV
 * @property Materiales $mA
 * @property TransaccionMateriales $tM
 */
class MatProvAdquirido extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mat_prov_adquirido';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PROV_ID', 'MA_ID'], 'required'],
            [['PROV_ID', 'MA_ID', 'TM_ID'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'AD_ID' => 'ID',
            'PROV_ID' => 'Proveedor',
            'MA_ID' => 'Material',
            'TM_ID' => 'Transacción',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPROV()
    {
        return $this->hasOne(Proveedor::className(), ['PROV_ID' => 'PROV_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMA()
    {
        return $this->hasOne(Materiales::className(), ['MA_ID' => 'MA_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTM()
    {
        return $this->hasOne(TransaccionMateriales::className(), ['TM_ID' => 'TM_ID']);
    }
}
