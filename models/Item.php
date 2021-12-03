<?php
namespace app\models;

use yii\db\ActiveRecord;

/**
 * Class Item
 * @package app\models
 *
 * @property int $id
 * @property string $name
 * @property int $showCount
 */
class Item extends ActiveRecord
{
    public static function tableName()
    {
        return '{{items}}';
    }

    public function getTagLinks()
    {
        return $this->hasMany(ItemTagLink::class, ['itemId' => 'id']);
    }
}
