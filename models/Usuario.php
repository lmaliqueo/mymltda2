<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usuario".
 *
 * @property integer $US_ID
 * @property string $PE_RUT
 * @property string $US_USSERNAME
 * @property string $US_PASSWORD
 * @property string $US_EMAIL
 * @property string $US_TIPO
 * @property string $US_DESCRIPCION
 *
 * @property Persona $pERUT
 * @property UsuariosControla[] $usuariosControlas
 */
class Usuario extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'usuario';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PE_RUT'], 'required'],
            [['PE_RUT'], 'string', 'max' => 12],
            [['US_USSERNAME', 'US_PASSWORD', 'US_EMAIL', 'US_DESCRIPCION'], 'string', 'max' => 50],
            [['US_TIPO'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'US_ID' => 'ID',
            'PE_RUT' => 'Persona',
            'US_USSERNAME' => 'Ussername',
            'US_PASSWORD' => 'Password',
            'US_EMAIL' => 'Email',
            'US_TIPO' => 'Tipo',
            'US_DESCRIPCION' => 'Descripción',
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
    public function getUsuariosControlas()
    {
        return $this->hasMany(UsuariosControla::className(), ['US_ID' => 'US_ID']);
    }
}
