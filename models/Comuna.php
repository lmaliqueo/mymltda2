<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comuna".
 *
 * @property integer $COM_ID
 * @property integer $CIU_ID
 * @property string $COM_NOMBRE
 *
 * @property Ciudad $cIU
 * @property EmpresaCliente[] $empresaClientes
 * @property Proyecto[] $proyectos
 */
class Comuna extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comuna';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CIU_ID'], 'required'],
            [['CIU_ID'], 'integer'],
            [['COM_NOMBRE'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'COM_ID' => 'ID',
            'CIU_ID' => 'Ciudad',
            'COM_NOMBRE' => 'Comuna',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCIU()
    {
        return $this->hasOne(Ciudad::className(), ['CIU_ID' => 'CIU_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmpresaClientes()
    {
        return $this->hasMany(EmpresaCliente::className(), ['COM_ID' => 'COM_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProyectos()
    {
        return $this->hasMany(Proyecto::className(), ['COM_ID' => 'COM_ID']);
    }
}
