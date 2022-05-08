<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\Post;

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
        return $this->render('index');
    }

    public function actionPost()
    {
        if(Yii::$app->request->isAjax){
            Yii::$app->request->post();
            return 'post';
        }

        $post = new Post();
        $post->time = time();
        $post->ip = Yii::$app->request->userIP;

        if($post->load(Yii::$app->request->post())){
            if($post->save()){
                Yii::$app->session->setFlash('success', 'Сообщение было отправлено');
                return $this->refresh();
            }
            else{
                Yii::$app->session->setFlash('error', 'Возникла ошибка! Сообщение не удалось отправить');
            }
        }

        return $this->render('post', ['post' => $post]);
    }

    public function actionRoute()
    {
        return $this->render('rules');
    }

    public function actionPgrid()
    {
        return $this->render('pgrid');
    }

    public function actionView($id)
    {
        $model = Post::findOne($id);

        if($model === null) {
            Yii::$app->session->setFlash('error', 'Даное сообщение не найдено');
            return $this->redirect('pgrid');
        }

        return $this->render('view', ['model' => $model]);
    }

    public function actionDelete($id)
    {
        $model = Post::findOne($id)->delete($id);

        return $this->redirect('pgrid');
    }
}
