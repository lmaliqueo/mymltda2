<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "dh_he_retiran".
 *
 * @property integer $RET_ID
 * @property string $HE_ID
 * @property integer $DH_ID
 *
 * @property DespachoHerramientas $dH
 * @property Herramientas $hE
 */
class DhHeRetiran extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dh_he_retiran';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['HE_ID', 'DH_ID'], 'required'],
            [['DH_ID'], 'integer'],
            [['HE_ID'], 'string', 'max' => 10],
            [['DH_ID'], 'exist', 'skipOnError' => true, 'targetClass' => DespachoHerramientas::className(), 'targetAttribute' => ['DH_ID' => 'DH_ID']],
            [['HE_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Herramientas::className(), 'targetAttribute' => ['HE_ID' => 'HE_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'RET_ID' => 'Ret  ID',
            'HE_ID' => 'He  ID',
            'DH_ID' => 'Dh  ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDH()
    {
        return $this->hasOne(DespachoHerramientas::className(), ['DH_ID' => 'DH_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHE()
    {
        return $this->hasOne(Herramientas::className(), ['HE_ID' => 'HE_ID']);
    }
}
