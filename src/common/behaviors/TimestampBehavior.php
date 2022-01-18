<?php

namespace common\behaviors;

class TimestampBehavior extends \yii\behaviors\TimestampBehavior
{
    protected function getValue($event): mixed
    {
        if ($this->value === null) {
            return \Yii::$app->formatter->asDate('now', 'php:Y-m-d H:i:s');
        }

        return parent::getValue($event);
    }
}
