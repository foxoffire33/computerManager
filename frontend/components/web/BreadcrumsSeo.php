<?php

namespace frontend\components\web;

use yii;
use yii\widgets\Breadcrumbs;
use yii\helpers\Json;
use yii\helpers\Url;

class BreadcrumsSeo extends Breadcrumbs{

    public static function makeBreadcrums($breadcrums = null) {
        $reutrn = null;
        $count = 0;
        if ($breadcrums != null) {
            $reutrn = [ '@context' => 'http://schema.org',
                '@type' => 'BreadcrumbList',
                'itemListElement' => []];
            foreach ($breadcrums as $item) {
                array_push($reutrn['itemListElement'], ["@type" => "ListItem",
                    'position' => ++$count,
                    'item' => [
                        '@id' => isset($item['url']) ? Url::to($item['url']) : Url::to([Yii::$app->homeUrl]),
                        'name' => isset($item['label']) ? $item['label'] : ''
                    ]
                ]);
            }
        }
        return Json::encode($reutrn);
    }
}