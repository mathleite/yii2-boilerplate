<?php

namespace api\rest;

use Yii;
use yii\base\ErrorException;
use yii\base\Exception;
use yii\base\UserException;
use yii\web\HttpException;

class ErrorHandler extends \yii\web\ErrorHandler
{
    protected function convertExceptionToArray($exception): array
    {
        if (!YII_DEBUG && !$exception instanceof UserException && !$exception instanceof HttpException) {
            $exception = new HttpException(500,
                Yii::t('yii', 'An internal server error occurred.'));
        }

        $array = [
            'error' => [
                'name' => ($exception instanceof Exception || $exception instanceof ErrorException)
                    ? $exception->getName()
                    : 'Exception',
                'message' => $exception->getMessage(),
                'code' => $exception->getCode(),
            ],
        ];

        if ($exception instanceof HttpException) {
            $array['error']['status'] = $exception->statusCode;
        }

        $details = [];
        if (YII_DEBUG) {
            $details['type'] = get_class($exception);
            if (!$exception instanceof UserException) {
                $details['file'] = $exception->getFile();
                $details['line'] = $exception->getLine();
                $details['stack-trace'] = explode("\n", $exception->getTraceAsString());

                if ($exception instanceof \yii\db\Exception) {
                    $details['error-info'] = $exception->errorInfo;
                }
            }
        }
        if (($prev = $exception->getPrevious()) !== null) {
            $details['previous'] = $this->convertExceptionToArray($prev);
        }

        if (!empty($details)) {
            $array['error']['details'] = $details;
        }

        return $array;
    }
}
