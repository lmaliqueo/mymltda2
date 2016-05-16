<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "authitem".
 *
 * @property string $name
 * @property integer $type
 * @property string $description
 * @property string $bizrule
 * @property string $data
 *
 * @property Authassignment[] $authassignments
 * @property Authitemchild[] $authitemchildren
 * @property Authitemchild[] $authitemchildren0
 */
class Authitem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'authitem';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'type'], 'required'],
            [['type'], 'integer'],
            [['description', 'bizrule', 'data'], 'string'],
            [['name'], 'string', 'max' => 64]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Name',
            'type' => 'Type',
            'description' => 'Description',
            'bizrule' => 'Bizrule',
            'data' => 'Data',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthassignments()
    {
        return $this->hasMany(Authassignment::className(), ['itemname' => 'name']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthitemchildren()
    {
        return $this->hasMany(Authitemchild::className(), ['parent' => 'name']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthitemchildren0()
    {
        return $this->hasMany(Authitemchild::className(), ['child' => 'name']);
    }
}
