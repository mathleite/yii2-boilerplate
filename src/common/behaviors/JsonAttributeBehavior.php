<?php

namespace common\behaviors;

use common\helpers\ArrayHelper;
use common\models\JsonModel;
use yii\base\Arrayable;
use yii\base\Behavior;
use yii\base\InvalidConfigException;
use yii\base\Model;
use yii\db\ActiveRecord;

class JsonAttributeBehavior extends Behavior
{
    public string $field;

    public string $jsonModel;

    public function init(): void
    {
        if (empty($this->field)) {
            throw new InvalidConfigException('The "field" config must be set.');
        }
        parent::init();
    }

    public function attach($owner): void
    {
        parent::attach($owner);
        $this->owner->{$this->field} = $this->instantiateModel();
    }

    public function events(): array
    {
        return [
            ActiveRecord::EVENT_AFTER_FIND => 'deserializeAttributes',
            ActiveRecord::EVENT_AFTER_INSERT => 'deserializeAttributes',
            ActiveRecord::EVENT_AFTER_UPDATE => 'deserializeAttributes',
            Model::EVENT_BEFORE_VALIDATE => 'deserializeAttributes',
        ];
    }

    public function deserializeAttributes(): void
    {
        /* @var $owner ActiveRecord */
        $owner = $this->owner;

        if (!empty($owner->{$this->field})) {
            $model = $this->instantiateModel();
            $attributes = $owner->{$this->field};
            $model->loadAttributes($attributes instanceof Arrayable
                ? ArrayHelper::toArrayRaw($attributes)
                : $attributes);
            $owner->{$this->field} = $model;
        }
    }

    private function instantiateModel(): JsonModel
    {
        $model = new $this->jsonModel();
        if (!$model instanceof JsonModel) {
            throw new InvalidConfigException(
                sprintf('The "jsonModel" config must be instance of %s', JsonModel::class));
        }
        return $model;
    }
}
