<?php

use yii\db\Migration;
use common\models\MaintenanceRequest;
class m160614_083701_mail extends Migration
{
    public function up()
    {
        $this->addColumn(MaintenanceRequest::tableName(),'mail_sended','INT');
    }

    public function down()
    {
        $this->dropColumn(MaintenanceRequest::tableName(),'mail_sended');
    }
}
