<?php

namespace app\controllers;

use Yii;
use app\models\WeatherNowArchive;
use app\models\DataWeatherNowArchive;
use app\models\PopularCity;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii2tech\csvgrid\CsvGrid;


/**
 * WeatherNowArchiveController implements the CRUD actions for WeatherNowArchive model.
 */
class WeatherNowArchiveController extends Controller
{

    public function __construct($id, $module)
    {
        parent::__construct($id, $module);
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        } else {
            return false;
        }
    }

    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all WeatherNowArchive models.
     * @return mixed
     */
    public function actionIndex()
    {

        $query = WeatherNowArchive::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProviderCities = new ArrayDataProvider([
            'allModels' => (new PopularCity)->getKnownCities(),
        ]);

        return $this->render('index', [
            'dataProviderCities' => $dataProviderCities,
            'dataProvider' => $dataProvider,
        ]);

    }

    /**
     * Displays a single WeatherNowArchive model.
     * @param int $id ID
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
     * Creates a new WeatherNowArchive model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new WeatherNowArchive();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing WeatherNowArchive model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing WeatherNowArchive model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionAddArchive()
    {
        $model = new WeatherNowArchive();

        $model->user_id = Yii::$app->user->identity->getId();
        $model->name_user = Yii::$app->user->identity->username;

        if ($model->save()) {
            (new PopularCity)->createKnownCities(Yii::$app->db->getLastInsertID());
            
        } 

    }

    public function actionExport($id)
    {
        return (new PopularCity)->exportKnownCities($id); 
    }


    /**
     * Finds the WeatherNowArchive model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return WeatherNowArchive the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = WeatherNowArchive::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
