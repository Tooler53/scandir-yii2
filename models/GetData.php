<?php
/**
 * Created by PhpStorm.
 * User: Toole
 * Date: 30.03.2019
 * Time: 8:56
 */

namespace app\models;

/**
 * This is the model class for table "site.outers".
 *
 * @property string $filename
 * @property string $filesize
 * @property string $filetype
 * @property string $filetime
 */

use yii\db\ActiveRecord;

class GetData extends ActiveRecord
{
    public static function tableName()
    {
        return 'dirfiles';
    }

    public function rules()
    {
        return[
            [['filename','filesize','filetype'], 'string', 'max' => 255],
            ['filetime','safe']
        ];
    }

    public function attributeLabels()
    {
        return[
            'filename' => 'Название файла/папки',
            'filesize' => 'Размер',
            'filetype' => 'Тип',
            'filetime' => 'Дата последней модификации'
        ];
    }
}