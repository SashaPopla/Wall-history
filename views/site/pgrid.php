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
            'attribute' => 'id',
            'label' => 'id'
        ],
        [
            'attribute' => 'author',
            'label' => 'Имя автора'
        ],
        [
            'attribute' => 'text',
            'label' => 'Сообщение',
            'format' => 'html'
        ],
        [
            'attribute' => 'time',
            'format' => 'relativeTime',
            'label' => 'Время отправки'
        ],
        [
            'attribute' => 'ip',
            'label' => 'IP'
        ],
        ['class' => 'yii\grid\ActionColumn'],
    ],
]);
?>