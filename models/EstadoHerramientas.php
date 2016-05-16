<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "estado_herramientas".
 *
 * @property integer $EH_ID
 * @property string $EH_NOMBREESTADO
 * @property string $EH_DESCRIPCION
 *
 * @property HerramientaTiene[] $herramientaTienes
 */
class EstadoHerramientas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'estado_herramientas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['EH_NOMBREESTADO'], 'string', 'max' => 20],
            [['EH_DESCRIPCION'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'EH_ID' => 'ID',
            'EH_NOMBREESTADO' => 'Estado',
            'EH_DESCRIPCION' => 'Descripcion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHerramientaTienes()
    {
        return $this->hasMany(HerramientaTiene::className(), ['EH_ID' => 'EH_ID']);
    }
}
