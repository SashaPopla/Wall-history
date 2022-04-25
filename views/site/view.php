<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\i18n\Formatter;

/** @var yii\web\View $this */

$this->title = 'Пост';
?>

<?php
echo DetailView::widget([
    'model' => $model,
    'attributes' => [
        'id',
        'author',
        [
            'attribute' =>'text',
            'format' => 'text',
        ],
        'ip',
        [
            'attribute' => 'time',
            'format' => 'relativeTime',
        ],
    ],

]);

echo Html::a('Назад', ['site/pgrid']);
