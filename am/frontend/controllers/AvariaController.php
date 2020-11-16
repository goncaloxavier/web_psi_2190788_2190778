<?php

namespace frontend\controllers;

use app\models\Dispositivo;
use Yii;
use app\models\Avaria;
use app\models\AvariaSearch;
use yii\base\Model;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

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
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
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
            $dispositivo = $model->idDispositivo0;
            if($model->gravidade == 0){
                $dispositivo->estado = 0;
            }else{
                $dispositivo->estado = 1;
            }
            $dispositivo->save();
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idAvaria]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
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
        $query = Avaria::find()->where(['idDispositivo' => $this->findModel($id)->idDispositivo , 'gravidade' => 0])->count();
        var_dump($query);

        if ($query != '1'){
            $this->findModel($id)->delete();
            return $this->redirect(['avaria/index']);
        }else{
            $dispositivo = $this->findModel($id)->idDispositivo0;
            $dispositivo->estado = 1;
            $dispositivo->save();
            $this->findModel($id)->delete();
            return $this->redirect(['avaria/index']);
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
