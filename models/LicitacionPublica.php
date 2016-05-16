<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "licitacion_publica".
 *
 * @property integer $LI_ID
 * @property string $EMP_RUT
 * @property string $LI_NOMBRE
 * @property string $LI_DESCRIPCION
 * @property string $LI_FECHAPOSTULACION
 * @property string $LI_ESTADO
 *
 * @property EmpresaCliente $eMPRUT
 */
class LicitacionPublica extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'licitacion_publica';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['EMP_RUT'], 'required'],
            [['LI_DESCRIPCION'], 'string'],
            [['LI_FECHAPOSTULACION'], 'safe'],
            [['EMP_RUT'], 'string', 'max' => 15],
            [['LI_NOMBRE'], 'string', 'max' => 50],
            [['LI_ESTADO'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'LI_ID' => 'ID',
            'EMP_RUT' => 'Empresa',
            'LI_NOMBRE' => 'Nombre',
            'LI_DESCRIPCION' => 'Descripción',
            'LI_FECHAPOSTULACION' => 'Fecha',
            'LI_ESTADO' => 'Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEMPRUT()
    {
        return $this->hasOne(EmpresaCliente::className(), ['EMP_RUT' => 'EMP_RUT']);
    }
}
