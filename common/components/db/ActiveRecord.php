<?php

/**
 * Created by PhpStorm.
 * User: reinier
 * Date: 01/03/16
 * Time: 19:16
 */
namespace common\components\db;

use yii\behaviors\TimestampBehavior;

class ActiveRecord extends \yii\db\ActiveRecord
{

    public function behaviors()
    {
        return [TimestampBehavior::className()];
    }

    public function beforeSave($insert)
    {
        if ($this->hasAttribute('created_at') && $this->hasAttribute('updated_at')) {
            $date = gmdate('Y-m-d h:i:s');
            if ($this->isNewRecord) {
                $this->created_at = $date;
            }
            $this->updated_at = $date;
        }
        return parent::beforeSave($insert);
    }
}