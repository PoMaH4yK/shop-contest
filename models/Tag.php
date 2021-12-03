<?php
namespace app\models;

use yii\db\ActiveRecord;

/**
 * Class Tag
 * @package app\models
 *
 * @property int $id
 * @property string $name
 */
class Tag extends ActiveRecord
{
    public static function tableName()
    {
        return '{{tags}}';
    }
}
