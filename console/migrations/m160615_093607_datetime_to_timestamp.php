<?php

use common\models\Brand;
use common\models\ComputerModel;
use common\models\ComputerSummary;
use common\models\Customer;
use common\models\Invoice;
use common\models\InvoiceRule;
use common\models\InvoiceRuleType;
use common\models\Log;
use common\models\MaintenanceRequest;
use common\models\Vat;
use yii\db\Migration;

class m160615_093607_datetime_to_timestamp extends Migration
{

    public function safeUp()
    {
        $this->updateTable(new vat);
        $this->updateTable(new MaintenanceRequest);
        $this->updateTable(new log);
        $this->updateTable(new Invoice);
        $this->updateTable(new InvoiceRule);
        $this->updateTable(new InvoiceRuleType);
        $this->updateTable(new Customer);
        $this->updateTable(new ComputerModel);
        $this->updateTable(new ComputerSummary);
        $this->updateTable(new Brand);
    }

    private function updateTable($model)
    {
        //rename columns
        $this->renameColumn($model::tableName(), 'datetime_created', 'created_at');
        $this->renameColumn($model::tableName(), 'datetime_updated', 'updated_at');
        //get current data
        $TempDataArray = $model::find()->select('id,created_at,updated_at')->asArray()->all();
      //  var_dump($TempDataArray);exit;
        //change column type
        $this->alterColumn($model::tableName(), 'created_at', 'INT');
        $this->alterColumn($model::tableName(), 'updated_at', 'INT');
        //update change columns with correct data
        if (!empty($TempDataArray)) {
            foreach ($TempDataArray as $data) {
                $this->update($model::tableName(), ['created_at' => strtotime($data['created_at']), 'updated_at' => strtotime($data['updated_at'])]);
            }
        }
    }

    public function safeDown()
    {
        $this->resetTable(new vat);
        $this->resetTable(new MaintenanceRequest);
        $this->resetTable(new log);
        $this->resetTable(new Invoice);
        $this->resetTable(new InvoiceRule);
        $this->resetTable(new InvoiceRuleType);
        $this->resetTable(new Customer);
        $this->resetTable(new ComputerModel);
        $this->resetTable(new ComputerSummary);
        $this->resetTable(new Brand);
    }

    private function resetTable($model)
    {
        $this->renameColumn($model::tableName(), 'created_at', 'datetime_created');
        $this->renameColumn($model::tableName(), 'updated_at', 'datetime_updated');

        $TempDataArray = $model::find()->select('id,datetime_created,datetime_updated')->asArray()->all();

        $this->alterColumn($model::tableName(), 'datetime_created', 'DATETIME');
        $this->alterColumn($model::tableName(), 'datetime_updated', 'DATETIME');

        if (!empty($TempDataArray)) {
            foreach ($TempDataArray as $data) {
                $this->update($model::tableName(), ['datetime_created' => gmdate('Y-m-d H:i:s',$data['datetime_created']), 'datetime_updated' => gmdate('Y-m-d H:i:s',$data['datetime_updated'])]);
            }
        }
    }

}
