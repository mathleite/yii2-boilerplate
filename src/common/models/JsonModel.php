<?php

namespace common\models;

use yii\base\Model;

abstract class JsonModel extends Model
{
    public function mapAttributeToModel(): array
    {
        return [];
    }

    public function loadAttributes(array $attributes, $safeOnly = true): void
    {
        $safeAttributes = $this->safeAttributes();

        foreach ($attributes as $attribute => $value) {
            if ($safeOnly && !in_array($attribute, $safeAttributes)) {
                continue;
            }

            if (is_array($value)) {
                if ($modelClass = $this->getAttributeModel($attribute)) {
                    /* @var $model JsonModel */
                    if (is_array($modelClass)) {
                        $model = new $modelClass[0]();
                        foreach ($value as $childValue) {
                            $model->loadAttributes($childValue);
                            $this->$attribute[] = $model;
                        }
                    } else {
                        $model = new $modelClass();
                        $model->loadAttributes($value);
                        $this->$attribute = $model;
                    }
                }
            } else {
                $this->$attribute = $value;
            }
        }
    }

    private function getAttributeModel(string $attribute): array|string|null
    {
        $attributes = $this->mapAttributeToModel();
        return $attributes[$attribute] ?? null;
    }
}
