<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "manodeobra_trabajan".
 *
 * @property integer $TRAB_ID
 * @property string $PE_RUT
 * @property integer $AC_ID
 *
 * @property Persona $pERUT
 * @property Actividades $aC
 */
class ManodeobraTrabajan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'manodeobra_trabajan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PE_RUT', 'AC_ID'], 'required'],
            [['AC_ID'], 'integer'],
            [['PE_RUT'], 'string', 'max' => 12]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'TRAB_ID' => 'ID',
            'PE_RUT' => 'Obrero',
            'AC_ID' => 'Actividad',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPERUT()
    {
        return $this->hasOne(Persona::className(), ['PE_RUT' => 'PE_RUT']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAC()
    {
        return $this->hasOne(Actividades::className(), ['AC_ID' => 'AC_ID']);
    }
}
