<?php

namespace backend\controllers;

use backend\components\web\BackendController;
use common\models\ComputerSummary;
use common\models\search\ComputerSummarySearch;
use Yii;
use yii\web\NotFoundHttpException;

/**
 * ComputerSummaryController implements the CRUD actions for ComputerSummary model.
 */
class ComputerSummaryController extends BackendController
{

    /**
     * Lists all ComputerSummary models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ComputerSummarySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ComputerSummary model.
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
     * Finds the ComputerSummary model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ComputerSummary the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ComputerSummary::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Creates a new ComputerSummary model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ComputerSummary();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ComputerSummary model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        $model->customerNameVirtual = (isset($model->customer->name) ? $model->customer->name : '');
        $model->modelNameVirtual = (isset($model->model) ? "{$model->model->brand->name}, {$model->model->name}" : '');
        return $this->render('update', ['model' => $model]);

    }

    /**
     * Deletes an existing ComputerSummary model.
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
