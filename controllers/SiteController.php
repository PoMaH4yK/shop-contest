<?php

namespace app\controllers;

use app\models\Item;
use app\models\ItemTagLink;
use app\models\Tag;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        if (\Yii::$app->request->isPost) {
            $query = Item::find()->joinWith('tagLinks as links', true, 'LEFT JOIN')
                ->where([
                    'not in', 'id', ItemTagLink::find()->select('itemId')
                        ->where(['tagId' => \Yii::$app->request->post('excludeTags')])
                ])
                ->orderBy('name')
                ->andFilterWhere(['links.tagId' => \Yii::$app->request->post('includeTags')]);

            ob_end_clean();

            header("Content-Type: application/force-download");
            header("Content-Type: application/octet-stream");
            header("Content-Type: application/download");
            header("Content-Disposition: attachment;filename=items.csv");
            header("Content-Transfer-Encoding: binary");

            $fp = fopen('php://output', 'w');

            foreach ($query->batch() as $rows) {
                $ids = [];

                /** @var Item $item */
                foreach ($rows as $item) {
                    $ids[] = $item->id;

                    fputcsv($fp, [iconv('UTF-8', 'Windows-1251', $item->name), $item->showCount], ';');
                }

                Item::updateAllCounters(['showCount' => 1], ['id' => $ids]);
            }

            fclose($fp);

            ob_flush();
            flush();

            die;
        }

        return $this->render('index', [
            'tags' => ArrayHelper::map(Tag::find()->all(), 'id', 'name')
        ]);
    }
}
