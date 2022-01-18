<?php

namespace common\validators;

use yii\base\InvalidConfigException;
use yii\validators\Validator;

class InstanceValidator extends Validator
{
    public string $of;

    /**
     * @inheritDoc
     * @throws InvalidConfigException
     */
    public function init(): void
    {
        parent::init();

        if (empty($this->of)) {
            throw new InvalidConfigException('The "of" property must be set.');
        }
        if ($this->message === null) {
            $this->message = '{attribute} must be instance of {object}.';
        }
    }

    protected function validateValue($value): ?array
    {
        if (!$value instanceof $this->of) {
            return [$this->message, ['object' => $this->of]];
        }
        return null;
    }
}
