<?php

use yii\db\Migration;
use common\models\Brand;

class m160322_135434_defaultData extends Migration
{
    public function safeUp()
    {
        $this->insert('user',[
            'email' => 'reinierdlp@gmail.com',
            'password_hash' => Yii::$app->security->generatePasswordHash('asdasd'),
            'status' => \common\models\User::STATUS_ACTIVE
        ]);

        $this->insert('brand',[
            'name' => 'Onbekend',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        $this->insert('computer_model',[
            'name' => 'Onbekend',
            'brand_id' => Brand::findOne(['name' => 'Onbekend'])->id,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        return true;
    }

    public function safeDown()
    {
        $this->delete('user',['email' => 'reinierdlp@gmail.com']);
        $this->delete('brand',['name' => 'Onbekend']);

        return true;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
