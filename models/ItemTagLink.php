<?php
namespace app\models;

use yii\db\ActiveRecord;

/**
 * Class ItemTagLink
 * @package app\models
 *
 * @property int $itemId
 * @property int $tagId
 */
class ItemTagLink extends ActiveRecord
{
    public static function tableName()
    {
        return '{{item_tag_links}}';
    }

    public function getItem()
    {
        return $this->hasOne(Item::class, ['id' => 'itemId']);
    }
}
