<?php

namespace backend\controllers;

use backend\components\web\BackendController;
use common\models\Invoice;
use common\models\InvoiceRule;
use common\models\search\InvoiceSearch;
use Yii;
use yii\base\Model;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;

/**
 * InvoiceController implements the CRUD actions for Invoice model.
 */
class InvoiceController extends BackendController
{

    /**
     * Lists all Invoice models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new InvoiceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Invoice model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Finds the Invoice model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Invoice the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Invoice::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Creates a new Invoice model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Invoice();
        $invoiceRuleModels = [];

        if (Yii::$app->request->isPost && ($count = count(Yii::$app->request->post('InvoiceRule', []))) > 0) {
            $count = count(Yii::$app->request->post('InvoiceRule', []));
            $invoiceRuleModels = [new InvoiceRule(['scenario' => InvoiceRule::SCENARIO_INVOICEFORM])];
            for ($i = 1; $i < $count; $i++) {
                $invoiceRuleModels[] = new InvoiceRule(['scenario' => InvoiceRule::SCENARIO_INVOICEFORM]);
            }
            if ($model->load(['Invoice' => Yii::$app->request->post('Invoice')]) && Model::loadMultiple($invoiceRuleModels, Yii::$app->request->post())) {
                $modelValidate = $model->validate();
                $invoiceRuleModelsValidate = Model::validateMultiple($invoiceRuleModels);
                if (($modelValidate && $invoiceRuleModelsValidate)) {
                    $model->save(false);
                    foreach ($invoiceRuleModels as $invoiceRuleModel) {
                        $invoiceRuleModel->invoice_id = $model->id;
                        $invoiceRuleModel->save(false);
                    }
                    $this->redirect(['/invoice/view', 'id' => $model->id]);
                }
            }
        } else {
            $invoiceRuleModels[] = new InvoiceRule();
            $model->invoice_date = date('Y-m-d');
        }

        $model->checkInvoiceNumber();
        return $this->render('create', ['model' => $model, 'invoiceRules' => $invoiceRuleModels]);

    }

    /**
     * Updates an existing Invoice model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $invoiceRuleModels = [];

        if (Yii::$app->request->isPost && ($count = count(Yii::$app->request->post('InvoiceRule', []))) > 0) {
            $postedInvoiceRules = Yii::$app->request->post('InvoiceRule', []);
            $postedInvoiceRules = array_values($postedInvoiceRules);
            for ($i = 0; $i < $count; $i++) {
                if (isset($postedInvoiceRules[$i]['id']) && !empty(($invoiceRule = InvoiceRule::findOne($postedInvoiceRules[$i]['id'])))) {
                    $invoiceRule->scenario = InvoiceRule::SCENARIO_INVOICEFORM;
                    $invoiceRuleModels[] = $invoiceRule;
                } else {
                    $invoiceRuleModels[] = new InvoiceRule(['scenario' => InvoiceRule::SCENARIO_INVOICEFORM]);
                }
            }
            //load
            if ($model->load(['Invoice' => Yii::$app->request->post('Invoice')]) && Model::loadMultiple($invoiceRuleModels, ['InvoiceRule' => $postedInvoiceRules])) {
                //delete in form deleted invoiceRules
                $deletedInvoiceRules = array_diff(ArrayHelper::getColumn($model->invoiceRules, 'id'), ArrayHelper::getColumn($invoiceRuleModels, 'id'));
                InvoiceRule::deleteAll(['in', 'id', $deletedInvoiceRules, 'invoice_id' => $model->id]);
                //is form validated
                $modelValidate = $model->validate();
                $invoiceRuleModelsValidate = Model::validateMultiple($invoiceRuleModels);
                if (($modelValidate && $invoiceRuleModelsValidate)) {
                    //save model
                    $model->save(false);
                    //save invoiceRules
                    foreach ($invoiceRuleModels as $invoiceRuleModel) {
                        $invoiceRuleModel->invoice_id = $model->id;
                        $invoiceRuleModel->save(false);
                    }
                    $this->redirect(['/invoice/view', 'id' => $model->id]);
                }
            }
        } else {
            $invoiceRuleModels = $model->invoiceRules;
        }

        $model->customerNameVirtual = (!empty($model->customer->name) ? $model->customer->name : $model->customerNameVirtual);
        return $this->render('update', ['model' => $model, 'invoiceRules' => $invoiceRuleModels]);

    }

    /**
     * Deletes an existing Invoice model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
}
