<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "persona".
 *
 * @property string $PE_RUT
 * @property integer $CA_ID
 * @property string $PE_NOMBRES
 * @property string $PE_APELLIDOPAT
 * @property string $PE_APELLIDOMAT
 * @property integer $PE_TELEFONO
 *
 * @property ContratoObrero[] $contratoObreros
 * @property ManodeobraTrabajan[] $manodeobraTrabajans
 * @property Cargo $cA
 * @property SolicitudPrestamo[] $solicitudPrestamos
 * @property Usuario[] $usuarios
 */
class Persona extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'persona';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PE_RUT', 'CA_ID','PE_NOMBRES', 'PE_APELLIDOPAT', 'PE_APELLIDOMAT'], 'required','message'=>'Este campo no debe estar vacío'],
            [['CA_ID', 'PE_TELEFONO'], 'integer'],
            [['PE_RUT'], 'string', 'max' => 12],
            [['PE_NOMBRES', 'CA_ID'], 'validateText','message'=>'Ingrese un nombre válido'],
            [['PE_NOMBRES', 'PE_APELLIDOPAT', 'PE_APELLIDOMAT'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'PE_RUT' => 'Rut',
            'CA_ID' => 'Cargo',
            'PE_NOMBRES' => 'Nombres',
            'PE_APELLIDOPAT' => 'Apellido Paterno',
            'PE_APELLIDOMAT' => 'Apellido Materno',
            'PE_TELEFONO' => 'Teléfono',
        ];
    }



    public function validateText($attribute, $params) {
        $pattern = '/^([a-zA-ZñÑÁÉÍÓÚáéíóú]+([[:space:]]{0,2}[a-zA-ZñÑÉÍÓÚáéíóú]+)*)$/';
            if($this->$attribute!=""){  
                if (!preg_match($pattern, $this->$attribute))
                    $this->addError($attribute,$params['message']);
            }
        }
    
    public function validateText2($attribute, $params) {
        $pattern = '/^([a-zA-ZñÑÁÉÍÓÚáéíóú0-9º°\.\,\'\"\)\(\-\@\:\/\+]+([[:space:]]{0,2}[a-zA-ZñÑÁÉÍÓÚáéíóú0-9º°\.\,\'\"\)\(\-\@\:\/\+]+)*)$/';
        $pattern2 = '/^([0-9º°\.\,\'\"\)\(\-\@\:\/\+]+)$/';
        if($this->$attribute!=""){
            if (!preg_match($pattern, $this->$attribute))
                $this->addError($attribute, $attribute.': Se deben ingresar letras o letras y números, verifique que no tenga espacios al final o en medio.');
            if (preg_match($pattern2, $this->$attribute))
                $this->addError($attribute, $attribute.': Error No puede ser solo números o caracteres especiales');
        }
    }
    public function validateText3($attribute, $params) {
        $pattern2 = '/(a{3}|e{3}|i{4}|o{3}|u{3}|b{3}|c{3}|d{3}|f{3}|g{3}|h{3}|j{3}|k{3}|l{4}|m{3}|n{3}|ñ{3}|p{3}|q{3}|r{3}|s{3}|t{3}|v{3}|w{4}|x{3}|y{3}|z{3}|º{2}|°{2}|\.{2}|\'{2}|\"{2}|\){2}|\({2}|\,{2}|\-{2}|\@{2}|\:{2}|\/{3}|\+{2})/i';
        $pattern3 = '/(A{3}|E{3}|I{4}|O{3}|U{3}|B{3}|C{3}|D{3}|F{3}|G{3}|H{3}|J{3}|K{3}|L{4}|M{3}|N{3}|Ñ{3}|P{3}|Q{3}|R{3}|S{3}|T{3}|V{3}|W{4}|X{3}|Y{3}|Z{3})/i';
        $pattern4 = '/(á{3}|Á{3}|é{3}|É{3}|í{3}|Í{3}|ó{3}|Ó{3}|ú{3}|Ú{3})/i';
        $pattern5 = '/([0-9]{13})/i';
        if($this->$attribute!=""){
            if (preg_match($pattern2, $this->$attribute) OR preg_match($pattern3, $this->$attribute) OR preg_match($pattern4, $this->$attribute))
                $this->addError($attribute, $attribute.': Verifique que no este repetidos continuamente los caracteres');
            if (preg_match($pattern5, $this->$attribute))
                $this->addError($attribute, $attribute.': No puede haber un número superior a 9999999999999');
        }
    }



    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContratoObreros()
    {
        return $this->hasMany(ContratoObrero::className(), ['PE_RUT' => 'PE_RUT']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getManodeobraTrabajans()
    {
        return $this->hasMany(ManodeobraTrabajan::className(), ['PE_RUT' => 'PE_RUT']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCA()
    {
        return $this->hasOne(Cargo::className(), ['CA_ID' => 'CA_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSolicitudPrestamos()
    {
        return $this->hasMany(SolicitudPrestamo::className(), ['PE_RUT' => 'PE_RUT']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarios()
    {
        return $this->hasMany(Usuario::className(), ['PE_RUT' => 'PE_RUT']);
    }
}
