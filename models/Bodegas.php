<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bodegas".
 *
 * @property integer $BO_ID
 * @property string $BO_NOMBRE
 * @property string $BO_DIRECCION
 * @property integer $BO_CANTIDADHERRAMIENTAS
 * @property integer $BO_CANTIDADMATERIALES
 *
 * @property BoMatAlmacena[] $boMatAlmacenas
 * @property Herramientas[] $herramientas
 * @property MatOrcAdquirido[] $matOrcAdquiridos 
 */
class Bodegas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bodegas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['BO_CANTIDADHERRAMIENTAS', 'BO_CANTIDADMATERIALES'], 'integer'],
            [['BO_NOMBRE', 'BO_DIRECCION'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'BO_ID' => 'ID',
            'BO_NOMBRE' => 'Bodega',
            'BO_DIRECCION' => 'Dirección',
            'BO_CANTIDADHERRAMIENTAS' => 'Cantidad Herramientas',
            'BO_CANTIDADMATERIALES' => 'Cantidad Materiales',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBoMatAlmacenas()
    {
        return $this->hasMany(BoMatAlmacena::className(), ['BO_ID' => 'BO_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHerramientas()
    {
        return $this->hasMany(Herramientas::className(), ['BO_ID' => 'BO_ID']);
    }
         
    /** 
     * @return \yii\db\ActiveQuery 
     */ 
    public function getMatOrcAdquiridos() 
    { 
        return $this->hasMany(MatOrcAdquirido::className(), ['BO_ID' => 'BO_ID']); 
    }
}

