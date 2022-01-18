<?php

namespace common\validators;

use common\models\JsonModel;
use yii\base\InvalidConfigException;
use yii\validators\Validator;

class JsonModelValidator extends Validator
{
    public array $errors = [];

    public string $jsonModel;

    /**
     * @throws InvalidConfigException
     */
    public function init(): void
    {
        parent::init();

        if (empty($this->jsonModel)) {
            throw new InvalidConfigException('The "jsonModel" property must be set.');
        }
        if (!(new $this->jsonModel()) instanceof JsonModel) {
            throw new InvalidConfigException(
                sprintf('The "jsonModel" config must be instance of %s', JsonModel::class));
        }
    }

    public function validateAttribute($model, $attribute): void
    {
        $this->validateJsonModel($model->$attribute, [$attribute]);
        $model->addErrors($this->errors);
    }

    private function validateJsonModel(JsonModel $model, array $prefix = []): void
    {
        if (!$model->validate()) {
            $firstError = $model->getFirstErrors();
            $this->errors[implode('.', array_merge($prefix, [key($firstError)]))] = $firstError;
        }

        foreach ($model->getAttributes() as $attributeName => $attribute) {
            if ($attribute instanceof JsonModel) {
                $prefix[] = $attributeName;
                $this->validateJsonModel($attribute, $prefix);
            } else if (is_array($attribute)) {
                $prefix[] = $attributeName;
                foreach ($attribute as $index => $childAttribute) {
                    if ($childAttribute instanceof JsonModel) {
                        $prefix['index'] = $index;
                        $this->validateJsonModel($childAttribute, $prefix);
                    }
                }
            }
        }
    }
}
