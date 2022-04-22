<?php

namespace app\models;

use yii\db\ActiveRecord;

class Post extends ActiveRecord
{
    public $reCaptcha;

    public static function tableName(){
        return 'post';
    }

    public function attributeLabels(){
        return [
            'author' => 'Автор',
            'text' => 'Сообщение',
        ];
    }

    public function rules(){
        return [
            [['author', 'text'], 'required'],
            ['author', 'string', 'min'=> 2],
            ['author', 'string', 'max'=> 15],
            ['text', 'string', 'min'=> 30],
            ['text', 'string', 'max'=> 1000],
            [['reCaptcha'], \himiklab\yii2\recaptcha\ReCaptchaValidator2::className(), 'secret' => '6LcztY4fAAAAAFXaiPADRTzkr5VFfUXNtXujHeRX', 'uncheckedMessage' => 'Пожалуйста, подтвердите, что вы не бот.'],
        ];
    }
}