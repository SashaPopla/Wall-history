<?php
/** @var yii\web\View $this
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\data\ActiveDataProvider;
use yii\widgets\ListView;
use app\models\Post;

$this->title = 'История';
?>
    <div class="site-index">
        <div class="jumbotron bg-transparent">
            <div class="row">
                <div class="col-lg-6">
                        <?php
                            $dataProvider = new ActiveDataProvider([
                                'query' => Post::find(),
                                'pagination' => [
                                'pageSize' => 3,
                                ],
                            ]);
                            echo ListView::widget([
                                'dataProvider' => $dataProvider,
                                'itemView' => '_post-item',
                            ]);
                        ?>
                </div>
                <div class="col-lg-6">
                    <?php if(Yii::$app->session->hasFlash('success')): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?php echo Yii::$app->session->getFlash('success') ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php endif; ?>

                    <?php if(Yii::$app->session->hasFlash('error')): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?php echo Yii::$app->session->getFlash('error') ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php endif; ?>

                    <?php $form=ActiveForm::begin() ?>
                    <?= $form->field($post, 'author') ?>
                    <?= $form->field($post, 'text')->textarea() ?>

                    <?= $form->field($post, 'reCaptcha')->widget(\himiklab\yii2\recaptcha\ReCaptcha2::className(), ['siteKey' => '6LccCDwfAAAAAAesx62P3f6b2zPigTPGnO33_1yj',]) ?>

                    <div class="form-group">
                        <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary', 'id' => 'btn']) ?>
                    </div>

                    <?php ActiveForm::end() ?>

                </div>
            </div>
        </div>
    </div>

<?php
$script = <<<JS
    $('#btn').on('click', function() {
        $.ajax({
            url: 'index.php?r=wall/index',
            type: 'POST',
            data: {
                test: '1323'
            },
            success: function (res) {
                console.log('Даные отправлены');
            },
            error: function (res){
                alert('Возникла ошибка');
            }
        });
    });
JS;

$this->registerJs($script);
?>