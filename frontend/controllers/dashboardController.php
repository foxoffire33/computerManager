<?php
namespace frontend\controllers;

use common\models\ComputerSummary;
use common\models\Invoice;
use frontend\components\web\FrontendController;
use mPDF;
use Yii;
use yii\web\NotFoundHttpException;

class DashboardController extends FrontendController
{

    public function actionIndex()
    {
        return $this->render('index', [
            'customer' => Yii::$app->user->identity->customer,
        ]);
    }

    /*
    public function actionDownloadInvoice($id)
    {
        if (!empty(($invoice = Invoice::findOne($id))) && Yii::$app->user->can('downloadOwnInvoice', ['id' => $id])) {
            $this->layout = '//print';
            $content = $this->render('invoicePdf', ['model' => $invoice]);

            $pdf = new mPDF();
            $pdf->WriteHTML($content);

            // return $content;

            return $pdf->Output("{$invoice->invoice_number}.pdf", 'D');
        }
        throw new NotFoundHttpException();
    }*/

    public function actionViewComputer($id)
    {
        if (!empty(($computer = ComputerSummary::findOne($id))) && Yii::$app->user->can('viewOwnComputer', ['id' => $id])) {
            return $this->render('computerView', ['model' => $computer]);
        }
        throw new NotFoundHttpException();
    }

    public function actionUpdateInformation()
    {
        if (!Yii::$app->user->isGuest && !empty(($customer = Yii::$app->user->identity->customer))) {
            if ($customer->load(Yii::$app->request->post()) && $customer->save()) {
                return $this->redirect('/dashboard');
            }
            return $this->render('forms/customerUpdateForm', ['model' => $customer]);
        }
        throw new NotFoundHttpException();
    }

}