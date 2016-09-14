<?php

namespace common\components\captcha;

use Yii;
use yii\captcha\CaptchaAction;
use yii\base\InvalidConfigException;
use yii\helpers\Url;
use yii\web\Response;

class NumCaptchaAction extends CaptchaAction {


    protected function generateVerifyCode() 
    {
    
        if ($this->minLength > $this->maxLength) {
            $this->maxLength = $this->minLength;
        }
        if ($this->minLength < 3) {
            $this->minLength = 3;
        }
        if ($this->maxLength > 8) {
            $this->maxLength = 8;
        }
        $length = mt_rand($this->minLength, $this->maxLength);

        $digits = '0123456789';
        $code = '';
        
        for ($i = 0; $i < $length; ++$i) {
            $code .= $digits[mt_rand(0, 9)];
        }

        return $code;
        
    }
}

