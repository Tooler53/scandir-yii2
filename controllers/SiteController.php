<?php

namespace app\controllers;

use app\models\GetData;
use app\models\GetDataSearch;
use app\models\ScanDir;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $counter = $_COOKIE['counter'];
        if ($counter == 1){
            $scan = new ScanDir();
            $scan->scan();
            $model = new GetDataSearch();
            return $this->render('index', ['searchModel' => $model, 'dataProvider' => $model->search(Yii::$app->request->get())]);
        }
        else {
            $model = new GetDataSearch();
            return $this->render('index', ['searchModel' => $model, 'dataProvider' => $model->search(Yii::$app->request->get())]);
        }
    }

    public function actionUpdate()
    {
        $data = new ScanDir();
        $table = new GetData();
        GetData::deleteAll();

        for ($i = 0; $i < count($data->scan()); $i++) {
            $table->id = false;
            $table->isNewRecord = true;
            $table->attributes = $data->scan()[$i];
            $table->save();
        }

        return $this->redirect(Yii::$app->request->referrer);
    }
}
