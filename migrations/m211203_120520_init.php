<?php

use yii\db\Migration;
use app\models\{Item, ItemTagLink, Tag};


/**
 * Class m211203_120520_init
 */
class m211203_120520_init extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(Item::tableName(), [
            'id' => $this->primaryKey(),
            'name' => $this->string(120)->notNull(),
            'showCount' => $this->integer()->notNull()->defaultValue(0)
        ]);

        $this->createTable(Tag::tableName(), [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()
        ]);

        $this->createTable(ItemTagLink::tableName(), [
            'itemId' => $this->integer()->notNull(),
            'tagId' => $this->integer()->notNull(),
        ]);

        $this->addPrimaryKey('item_tag', \app\models\ItemTagLink::tableName(), ['tagId', 'itemId']);

        $this->batchInsert(Item::tableName(), ['name', 'showCount'], [
            ['Кроссовки Nike', 5],
            ['Джинсы Levi\'s', 10],
            ['Куртка NORMANN', 0],
            ['Футболка Adidas', 1],
        ]);

        $this->batchInsert(Tag::tableName(), ['name'], [
            ['одежда'],
            ['обувь'],
            ['стиль'],
            ['повседневное'],
            ['черное'],
            ['белое'],
        ]);

        $this->batchInsert(ItemTagLink::tableName(), ['itemId', 'tagId'], [
            [1, 2],
            [1, 3],
            [1, 5],
            [2, 1],
            [2, 4],
            [3, 1],
            [3, 4],
            [3, 6],
            [4, 1],
            [4, 6],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(\app\models\ItemTagLink::tableName());
        $this->dropTable(\app\models\Tag::tableName());
        $this->dropTable(\app\models\Item::tableName());
    }
}
