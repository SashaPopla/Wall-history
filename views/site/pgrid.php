<?php

use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use app\models\Post;
use yii\grid\GridView;

/** @var yii\web\View $this */

$this->title = 'Грид-виджер';
?>

<?php
    $dataProvider = new ActiveDataProvider([
        'query' => Post::find(),
        'pagination' => [
            'pageSize' => 5,
        ],
    ]);

    echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        [
            'class' => 'yii\grid\SerialColumn'
        ],
        [
            'attribute' => 'author',
            'label' => 'Имя автора'
        ],
        [
            'attribute' => 'text',
            'label' => 'Сообщение'
        ],
        [
            'attribute' => 'time',
            'format' => ['date', 'php:Y-m-d'],
            'label' => 'Время отправки'
        ],
        [
            'attribute' => 'ip',
            'label' => 'IP'
        ],
    ],
]);
?>