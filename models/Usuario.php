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
class Usuario extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
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
            [['US_USERNAME', 'US_PASSWORD', 'US_EMAIL', 'US_DESCRIPCION', 'US_AUTHKEY'], 'string', 'max' => 50],
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
            'US_USERNAME' => 'Usuario',
            'US_PASSWORD' => 'Password',
            'US_EMAIL' => 'Email',
            'US_TIPO' => 'Tipo',
            'US_DESCRIPCION' => 'Descripción',
            'US_AUTHKEY' => 'Us  Authkey',
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





    public static function findIdentity($id){
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null){
        throw new NotSupportedException();//I don't implement this method because I don't have any access token column in my database
    }

    public function getId(){
        return $this->US_ID;
    }

    public function getAuthKey(){
        return $this->US_AUTHKEY;//Here I return a value of my authKey column
    }

    public function validateAuthKey($authKey){
        return $this->US_AUTHKEY === $authKey;
    }
    public static function findByUsername($username){
        return self::findOne(['US_USERNAME'=>$username]);
    }

    public function validatePassword($password){
        if ($this->US_PASSWORD === $this->hashPassword($password)) {
            return $this->US_PASSWORD === $this->hashPassword($password);
        }else{
            return $this->US_PASSWORD === $password;
        }
    }

    public function hashPassword($password)
    {
        return md5($password);
    }

}
