<?php

namespace common\validators;

class DateValidator extends \yii\validators\DateValidator
{
    public $format = 'php:Y-m-d';
}
