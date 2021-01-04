<?php

namespace frontend\controllers;

use app\models\Avaria;
use app\models\Relatoriopeca;
use common\models\Utilizador;
use Yii;
use app\models\Relatorio;
use app\models\RelatorioSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RelatorioController implements the CRUD actions for Relatorio model.
 */
class RelatorioController extends Controller
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
                        'allow' => false,
                        'roles' => ['funcionario'],
                    ],
                    [
                        'actions' => ['index', 'view', 'update','create', 'delete'],
                        'allow' => true,
                        'roles' => ['tecnico'],
                    ],
                    [
                        'actions' => ['index', 'view', 'update','create', 'delete'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Relatorio models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RelatorioSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Relatorio model.
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
     * Creates a new Relatorio model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($idAvaria)
    {
        $model = new Relatorio();

        $model->idAvaria = $idAvaria;
        $modelAvaria = Avaria::findOne($idAvaria);
        $model->idDispositivo = $modelAvaria->idDispositivo;
        $utilizador = Utilizador::findOne($modelAvaria->idUtilizador);
        $model->autor = $utilizador->nomeUtilizador;
        $model->descricaoA = $modelAvaria->descricao;
        $model->idUtilizador = Yii::$app->user->getId();

        if ($model->load(Yii::$app->request->post())) {
            $post = Yii::$app->request->post('Relatorio');
            $model->listPecas = $post['listPecas'];
            $model->save();
            return $this->redirect(['view', 'id' => $model->idRelatorio]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Relatorio model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelAvaria = Avaria::findOne($model->idAvaria);
        $utilizador = Utilizador::findOne($modelAvaria->idUtilizador);
        $model->autor = $utilizador->nomeUtilizador;
        $model->descricaoA = $modelAvaria->descricao;
        $model->listPecas = $model->getRelatedPecas();

        if ($model->load(Yii::$app->request->post())) {
            $post = Yii::$app->request->post('Relatorio');
            $model->listPecas = $post['listPecas'];
            $model->save();
            return $this->redirect(['view', 'id' => $model->idRelatorio]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Relatorio model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Relatorio model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Relatorio the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Relatorio::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
