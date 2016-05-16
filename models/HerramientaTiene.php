<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "herramienta_tiene".
 *
 * @property integer $HT_ID
 * @property integer $EH_ID
 * @property integer $HE_ID
 * @property integer $HT_CANTHEESTADO
 *
 * @property EstadoHerramientas $eH
 * @property Herramientas $hE
 */
class HerramientaTiene extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'herramienta_tiene';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['EH_ID', 'HE_ID'], 'required'],
            [['EH_ID', 'HE_ID', 'HT_CANTHEESTADO'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'HT_ID' => 'ID',
            'EH_ID' => 'Estado',
            'HE_ID' => 'Herramienta',
            'HT_CANTHEESTADO' => 'Cantidad',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEH()
    {
        return $this->hasOne(EstadoHerramientas::className(), ['EH_ID' => 'EH_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHE()
    {
        return $this->hasOne(Herramientas::className(), ['HE_ID' => 'HE_ID']);
    }
}
