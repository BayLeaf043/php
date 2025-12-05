<?php

namespace app\controllers;

use app\models\AdminArticle;
use app\models\AdminArticleSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\UploadedFile;
use Yii;

/**
 * AdminArticleController implements the CRUD actions for AdminArticle model.
 */
class AdminArticleController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['index', 'view', 'create', 'update', 'delete'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'], // тільки авторизовані
                        'matchCallback' => function () {
                            // дозволяємо тільки логіну admin123
                            return !Yii::$app->user->isGuest
                                && Yii::$app->user->identity->login === 'admin123';
                        },
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all AdminArticle models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new AdminArticleSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AdminArticle model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new AdminArticle model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
{
    $model = new AdminArticle();

    if ($model->load(Yii::$app->request->post())) {

        $model->imageFile = UploadedFile::getInstance($model, 'imageFile');

        if ($model->validate() && $model->uploadImage() && $model->save(false)) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
    }

    return $this->render('create', [
        'model' => $model,
    ]);
}

    /**
     * Updates an existing AdminArticle model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
{
    $model = $this->findModel($id);
    $oldImage = $model->image;

    if ($model->load(Yii::$app->request->post())) {

        $model->imageFile = UploadedFile::getInstance($model, 'imageFile');

        if ($model->imageFile) {
            $model->uploadImage(); // оновлюємо файл і шлях
        } else {
            $model->image = $oldImage; // залишаємо старе зображення
        }

        if ($model->save(false)) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
    }

    return $this->render('update', [
        'model' => $model,
    ]);
}

    /**
     * Deletes an existing AdminArticle model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the AdminArticle model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return AdminArticle the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AdminArticle::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
