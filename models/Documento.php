<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "documento".
 *
 * @property integer $id_documento
 * @property string $nombre
 * @property string $link
 * @property string $fecha
 *
 * @property EducadoraGestionaDocumento[] $educadoraGestionaDocumentos
 */
class Documento extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
     public $file;
    public static function tableName()
    {
        return 'documento';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'nombre'], 'required'],
            [['id_documento'], 'integer'],
            [['fecha'], 'safe'],
            [['file'],'file'],
            [['nombre'], 'string', 'max' => 100],
            [['link'], 'string', 'max' => 250]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_documento' => 'Id Documento',
            'nombre' => 'Nombre',
            'link' => 'Link',
            'fecha' => 'Fecha',
            'file'=>'Link',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEducadoraGestionaDocumentos()
    {
        return $this->hasMany(EducadoraGestionaDocumento::className(), ['id_documento' => 'id_documento']);
    }
}
