<?php

namespace app\components;

use Yii;

class Helper
{
    public static function formatNumber($value)
    {
        if ($value==-1) {
            return '--';
        } else {
            return  $value;
        }
    }
}