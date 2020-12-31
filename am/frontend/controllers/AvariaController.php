<?php

namespace frontend\controllers;

use app\models\Dispositivo;
use app\models\Relatorio;
use Yii;
use app\models\Avaria;
use app\models\AvariaSearch;
use yii\base\Model;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\rbac\ManagerInterface;

/**
 * AvariaController implements the CRUD actions for Avaria model.
 */
class AvariaController extends Controller
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
                        'actions' => ['index', 'view', 'update', 'create', 'delete'],
                        'allow' => true,
                        'roles' => ['funcionario'],
                    ],
                    [
                        'actions' => ['index', 'view', 'update','create', 'delete'],
                        'allow' => true,
                        'roles' => ['tecnico'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Avaria models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AvariaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Avaria model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Avaria model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Avaria();

        $model->estado = 1;
        $model->data = date("Y-m-d H:i:s");

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idAvaria]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Avaria model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if (\Yii::$app->user->can('updateOwnAvaria', ['avaria' => $model]) || Yii::$app->user->identity->tipo != 1) {
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                if($model->estado == 3 && Relatorio::find()->where(["idAvaria" => $id])){
                    $this->redirect(['relatorio/create', 'idAvaria' => $model->idAvaria]);
                }
                else{
                    return $this->redirect(['view', 'id' => $model->idAvaria]);
                }
            }

            return $this->render('update', [
                'model' => $model,
            ]);
        }else{
            throw new ForbiddenHttpException("You are not allowed to perform this action.");
        }
   }

    /**
     * Deletes an existing Avaria model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if (\Yii::$app->user->can('updateOwnAvaria', ['avaria' => $model]) || Yii::$app->user->identity->tipo != 1) {
            $this->findModel($id)->delete();
            return $this->redirect(['avaria/index']);
        }else{
            throw new ForbiddenHttpException("You are not allowed to perform this action.");
        }

    }

    /**
     * Finds the Avaria model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Avaria the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Avaria::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
