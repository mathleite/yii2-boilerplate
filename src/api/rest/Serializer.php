<?php

namespace api\rest;

class Serializer extends \yii\rest\Serializer
{
    public $collectionEnvelope = 'items';

    public const INVALID_DATA_STATUS_CODE = 422;
    public const INVALID_DATA_MESSAGE = 'Data Validation Failed.';

    protected function serializeModelErrors($model): array
    {
        $this->response->setStatusCode(self::INVALID_DATA_STATUS_CODE, self::INVALID_DATA_MESSAGE);

        $fields = [];
        foreach ($model->getFirstErrors() as $name => $message) {
            $fields[] = [
                'field' => $name,
                'message' => $message,
            ];
        }

        return [
            'error' => [
                'name' => 'Invalid Data',
                'message' => self::INVALID_DATA_MESSAGE,
                'fields' => $fields
            ],
            'status' => self::INVALID_DATA_STATUS_CODE,
        ];
    }
}
