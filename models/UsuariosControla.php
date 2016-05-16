<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usuarios_controla".
 *
 * @property integer $USCON_ID
 * @property integer $US_ID
 * @property integer $PRO_ID
 *
 * @property Usuario $uS
 * @property Proyecto $pRO
 */
class UsuariosControla extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'usuarios_controla';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['US_ID', 'PRO_ID'], 'required'],
            [['US_ID', 'PRO_ID'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'USCON_ID' => 'ID',
            'US_ID' => 'Usuario',
            'PRO_ID' => 'Proyecto',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUS()
    {
        return $this->hasOne(Usuario::className(), ['US_ID' => 'US_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPRO()
    {
        return $this->hasOne(Proyecto::className(), ['PRO_ID' => 'PRO_ID']);
    }
}
