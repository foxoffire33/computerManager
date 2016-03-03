<?php

use yii\db\Migration;
use yii\helpers\ArrayHelper;

class m160302_130128_createDB extends Migration
{
    public function safeUp()
    {
        $this->dropColumn('user','username');
        $this->addColumn('user','customer_id','integer');

        $this->createTable('customer', ArrayHelper::merge([
            'id' => $this->primaryKey(11)->unique(),
            'name' => $this->string(128),
            'adres' => $this->string(128),
            'zipcode' => $this->string(128),
            'city' => $this->string(128),
            'email' => $this->string(128),
            'phone' => $this->string(14),
            'iban' => $this->string(128),
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
            'id' => $this->primaryKey(11)->unique(),
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

        $this->createTable('maintenance_request',ArrayHelper::merge([
            'id' => $this->primaryKey(11)->unique(),
            'computer_id' => $this->integer(11),
            'status' => $this->smallInteger(1),
            'description' => $this->text(),
            'date_done' => $this->date(),
            'date_apointment' => $this->date(),
        ],$this->getDatetimeUpdateAndCreate()));

        $this->createTable('computer_summary',ArrayHelper::merge([
            'id' => $this->primaryKey(11)->unique(),
            'name' => $this->string(128),
            'customer_id' => $this->integer(11),
            'type_id' => $this->smallInteger(1),
            'model_id' => $this->integer(11),
            'serial_number' => $this->string(128)
        ],$this->getDatetimeUpdateAndCreate()));

        $this->createTable('computer_model',ArrayHelper::merge([
            'id' => $this->primaryKey(11)->unique(),
            'brand_id' => $this->integer(11),
            'name' => $this->string(128),
        ],$this->getDatetimeUpdateAndCreate()));

        $this->createTable('brand',ArrayHelper::merge([
            'id' => $this->primaryKey(11),
            'name' => $this->string(128),
            'country' => $this->string(128),
            'address' => $this->string(128),
            'zipcode' => $this->string(128),
            'city' => $this->string(128),
            'email' => $this->string(128),
            'phone' => $this->string(128),
            'webpage' => $this->string(128)
        ],$this->getDatetimeUpdateAndCreate()));

        $this->createTable('log',ArrayHelper::merge([
            'id' => $this->primaryKey(11)->unique(),
            'computer_id' => $this->integer(11),
            'type_id' => $this->smallInteger(1),
            'mode' => $this->smallInteger(1),
            'event_datetime' => $this->dateTime(),
            'description' => $this->text()
        ],$this->getDatetimeUpdateAndCreate()));



        $this->addForeignKey('customer_id_user', 'user', 'customer_id', 'customer', 'id', 'CASCADE', 'NO ACTION');
        $this->addForeignKey('customer_id_invoice_fk', 'invoice', 'customer_id', 'customer', 'id', 'CASCADE', 'NO ACTION');
        $this->addForeignKey('invoice_id_fk', 'invoice_rule', 'invoice_id', 'invoice', 'id', 'CASCADE', 'NO ACTION');
        $this->addForeignKey('type_id_fk', 'invoice_rule', 'type_id', 'invoice_rule_type', 'id', 'CASCADE', 'NO ACTION');
        $this->addForeignKey('vat_id_fk', 'invoice_rule', 'vat_id', 'vat', 'id', 'CASCADE', 'NO ACTION');
        $this->addForeignKey('compuster_id_fk', 'maintenance_request', 'computer_id', 'computer_summary', 'id', 'CASCADE', 'NO ACTION');
        $this->addForeignKey('customer_id_computer_fk','computer_summary','customer_id','customer','id','CASCADE','NO ACTION');
        $this->addForeignKey('model_id_fk','computer_summary','model_id','computer_model','id','CASCADE','NO ACTION');
        $this->addForeignKey('brand_id_model_fk','computer_model','brand_id','brand','id','CASCADE','NO ACTION');
        $this->addForeignKey('computer_id_log_fk','log','computer_id','computer_summary','id','CASCADE','NO ACTION');



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
        //delete relations
        $this->dropForeignKey('customer_id_user','user');
        $this->dropForeignKey('customer_id_invoice_fk','invoice');
        $this->dropForeignKey('invoice_id_fk','invoice_rule');
        $this->dropForeignKey('type_id_fk','invoice_rule');
        $this->dropForeignKey('vat_id_fk','invoice_rule');
        $this->dropForeignKey('compuster_id_fk','maintenance_request');
        $this->dropForeignKey('customer_id_computer_fk','computer_summary');
        $this->dropForeignKey('model_id_fk','computer_summary');
        $this->dropForeignKey('brand_id_model_fk','computer_model');
        $this->dropForeignKey('computer_id_log_fk','log');
        //delete tables
        $this->dropTable('customer');
        $this->dropTable('invoice');
        $this->dropTable('invoice_rule_type');
        $this->dropTable('invoice_rule');
        $this->dropTable('vat');
        $this->dropTable('maintenance_request');
        $this->dropTable('computer_summary');
        $this->dropTable('computer_model');
        $this->dropTable('brand');
        $this->dropTable('log');

        //copy data
        $this->renameColumn('user','email','username');
        $this->addColumn('user','email','string');
        return true;
    }

}
