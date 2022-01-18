<?php

namespace common\exceptions;

use Throwable;
use yii\base\Exception;
use yii\base\Model;

class DataValidationException extends Exception
{
    public function __construct(
        Model $model, $defaultMessage = "Validation Error", $code = 422, Throwable $previous = null)
    {
        $message = $defaultMessage;

        if ($firstErrors = $model->getFirstErrors()) {
            $firstError = reset($firstErrors);
            $message = sprintf('[%s] %s: %s', $model::class, $defaultMessage, $firstError);
        }
        parent::__construct($message, $code, $previous);
    }
}
