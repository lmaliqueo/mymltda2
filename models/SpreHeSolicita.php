<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "spre_he_solicita".
 *
 * @property integer $SOLI_ID
 * @property integer $SPRE_ID
 * @property string $HE_ID
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
            [['SPRE_ID'], 'required'],
            [['SPRE_ID'], 'integer'],
            [['HE_ID'], 'string', 'max' => 10],
            [['SPRE_ID'], 'exist', 'skipOnError' => true, 'targetClass' => SolicitudPrestamo::className(), 'targetAttribute' => ['SPRE_ID' => 'SPRE_ID']],
            [['HE_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Herramientas::className(), 'targetAttribute' => ['HE_ID' => 'HE_ID']],
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
