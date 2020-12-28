<?php

namespace frontend\controllers;

use Yii;
use app\models\RelatorioPeca;
use app\models\RelatorioPecaSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RelatorioPecaController implements the CRUD actions for RelatorioPeca model.
 */
class RelatorioPecaController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'view', 'create', 'delete'],
                        'allow' => false,
                        'roles' => ['funcionario'],
                    ],
                    [
                        'actions' => ['index', 'view', 'create', 'delete'],
                        'allow' => true,
                        'roles' => ['tecnico'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all RelatorioPeca models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RelatorioPecaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RelatorioPeca model.
     * @param integer $idRelatorio
     * @param integer $idPeca
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($idRelatorio, $idPeca)
    {
        return $this->render('view', [
            'model' => $this->findModel($idRelatorio, $idPeca),
        ]);
    }

    /**
     * Creates a new RelatorioPeca model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new RelatorioPeca();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idRelatorio' => $model->idRelatorio, 'idPeca' => $model->idPeca]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing RelatorioPeca model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $idRelatorio
     * @param integer $idPeca
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($idRelatorio, $idPeca)
    {
        $model = $this->findModel($idRelatorio, $idPeca);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idRelatorio' => $model->idRelatorio, 'idPeca' => $model->idPeca]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing RelatorioPeca model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $idRelatorio
     * @param integer $idPeca
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($idRelatorio, $idPeca)
    {
        $this->findModel($idRelatorio, $idPeca)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the RelatorioPeca model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $idRelatorio
     * @param integer $idPeca
     * @return RelatorioPeca the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idRelatorio, $idPeca)
    {
        if (($model = RelatorioPeca::findOne(['idRelatorio' => $idRelatorio, 'idPeca' => $idPeca])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
