<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "authassignment".
 *
 * @property string $itemname
 * @property string $userid
 * @property string $bizrule
 * @property string $data
 *
 * @property Authitem $itemname0
 */
class Authassignment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'authassignment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['itemname', 'userid'], 'required'],
            [['bizrule', 'data'], 'string'],
            [['itemname', 'userid'], 'string', 'max' => 64]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'itemname' => 'Itemname',
            'userid' => 'Userid',
            'bizrule' => 'Bizrule',
            'data' => 'Data',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemname0()
    {
        return $this->hasOne(Authitem::className(), ['name' => 'itemname']);
    }
}
