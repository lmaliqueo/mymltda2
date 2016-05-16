<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "spre_he_solicita".
 *
 * @property integer $SOLI_ID
 * @property integer $SPRE_ID
 * @property integer $HE_ID
 * @property integer $SOLI_CANTIDAD
 *
 * @property SolicitudPrestamo $sPRE
 * @property Herramientas $hE
 */
class SpreHeSolicita extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'spre_he_solicita';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['HE_ID'], 'required'],
            [['SPRE_ID', 'HE_ID', 'SOLI_CANTIDAD'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'SOLI_ID' => 'ID',
            'SPRE_ID' => 'Solicitud',
            'HE_ID' => 'Herramienta',
            'SOLI_CANTIDAD' => 'Cantidad',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSPRE()
    {
        return $this->hasOne(SolicitudPrestamo::className(), ['SPRE_ID' => 'SPRE_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHE()
    {
        return $this->hasOne(Herramientas::className(), ['HE_ID' => 'HE_ID']);
    }
}
