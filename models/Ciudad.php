<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ciudad".
 *
 * @property integer $CIU_ID
 * @property integer $PROVI_ID
 * @property string $CIU_NOMBRE
 *
 * @property Provincia $pROVI
 * @property Comuna[] $comunas
 */
class Ciudad extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ciudad';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PROVI_ID'], 'required'],
            [['PROVI_ID'], 'integer'],
            [['CIU_NOMBRE'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'CIU_ID' => 'ID',
            'PROVI_ID' => 'Provincia',
            'CIU_NOMBRE' => 'Ciudad',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPROVI()
    {
        return $this->hasOne(Provincia::className(), ['PROVI_ID' => 'PROVI_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComunas()
    {
        return $this->hasMany(Comuna::className(), ['CIU_ID' => 'CIU_ID']);
    }
}
