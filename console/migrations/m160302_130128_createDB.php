<?php

use yii\db\Migration;
use yii\helpers\ArrayHelper;

class m160302_130128_createDB extends Migration
{
    public function safeUp()
    {
        $this->createTable('customer', ArrayHelper::merge([
            'id' => $this->primaryKey(11),
            'name' => $this->string(128),
            'adres' => $this->string(128),
            'zipcode' => $this->string(128),
            'city' => $this->string(128),
            'email' => $this->string(128),
            'phone' => $this->string(14),
            'iban' => $this->string(128),
        ], $this->getDatetimeUpdateAndCreate()));

        $this->createTable('customer_user_relation',
            ArrayHelper::merge([
                'user_id' => $this->integer(11)->unique(),
                'customer_id' => $this->integer()->unique(),
            ], $this->getDatetimeUpdateAndCreate()));

        $this->createTable('invoice', ArrayHelper::merge([
            'id' => $this->primaryKey(11)->unique(),
            'customer_id' => $this->integer(11),
            'reference' => $this->string(128),
            'invoice_number' => $this->string(128),
            'payed' => $this->boolean()->defaultValue(false),
            'description' => $this->text()
        ], $this->getDatetimeUpdateAndCreate()));
        //set relations


        $this->createTable('invoice_rule_type',ArrayHelper::merge([
            'id' => $this->primaryKey(11)->unique(),
            'name' => $this->string(128)
        ],$this->getDatetimeUpdateAndCreate()));

        $this->createTable('vat',ArrayHelper::merge([
            'id' => $this->integer(11)->unique(),
            'name' => $this->string(128),
            'procentage' => $this->smallInteger(2)
        ],$this->getDatetimeUpdateAndCreate()));

        $this->createTable('invoice_rule', ArrayHelper::merge([
            'id' => $this->primaryKey(11)->unique(),
            'invoice_id' => $this->integer(11),
            'type_id' => $this->integer(11),
            'vat_id' => $this->integer(11),
            'name' => $this->string(128),
            'price' => $this->float(),
            'quantity' => $this->float(),
        ],$this->getDatetimeUpdateAndCreate()));

        $this->addForeignKey('user_id_fk', 'customer_user_relation', 'user_id', 'user', 'id', 'CASCADE', 'NO ACTION');
        $this->addForeignKey('customer_id_user_relation_fk', 'customer_user_relation', 'customer_id', 'customer', 'id', 'CASCADE', 'NO ACTION');
        $this->addForeignKey('customer_id_invoice_fk', 'invoice', 'customer_id', 'customer', 'id', 'CASCADE', 'NO ACTION');
        $this->addForeignKey('invoice_id_fk', 'invoice_rule', 'invoice_id', 'invoice', 'id', 'CASCADE', 'NO ACTION');
        $this->addForeignKey('type_id_fk', 'invoice_rule', 'type_id', 'invoice_rule_type', 'id', 'CASCADE', 'NO ACTION');
        $this->addForeignKey('vat_id_fk', 'invoice_rule', 'vat_id', 'vat', 'id', 'CASCADE', 'NO ACTION');


    }

    private function getDatetimeUpdateAndCreate()
    {
        return [
            'datetime_created' => $this->dateTime(),
            'datetime_updated' => $this->dateTime()
        ];
    }

    public function safeDown()
    {
       // $this->delete('customer_user_relation');
       // $this->delete('customer');
        return true;
    }

}
