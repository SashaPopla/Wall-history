<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
?>
<div class="card card-default">
    <h2><?= Html::encode($model->author) ?></h2>
    <p> <?= HtmlPurifier::process($model->text) ?> </p>
    <small><?= Yii::$app->formatter->asRelativeTime($model->time)?> <?php echo " | ". $model->ip; ?></small>
    <?= Html::a('<small class="glyphicon glyphicon-view">Коментарий</small>',
        [
           '/site/view',
           'id' => $model->id]
        );
    ?>
</div>
