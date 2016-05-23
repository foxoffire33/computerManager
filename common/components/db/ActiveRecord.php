<?php

/**
 * Created by PhpStorm.
 * User: reinier
 * Date: 01/03/16
 * Time: 19:16
 */
namespace common\components\db;

class ActiveRecord extends \yii\db\ActiveRecord
{
    public function beforeSave($insert)
    {
        if ($this->hasAttribute('datetime_created') && $this->hasAttribute('datetime_updated')) {
            $date = gmdate('Y-m-d h:i:s');
            if ($this->isNewRecord) {
                $this->datetime_created = $date;
            }
            $this->datetime_updated = $date;
        }
        return parent::beforeSave($insert);
    }
}