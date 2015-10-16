<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "foto".
 *
 * @property integer $id_foto
 * @property string $titutlo
 * @property string $link
 */
class Foto extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'foto';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['titutlo', 'link'], 'required'],
            [['titutlo'], 'string', 'max' => 100],
            [['link'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_foto' => 'Id Foto',
            'titutlo' => 'Titutlo',
            'link' => 'Link',
        ];
    }
}
