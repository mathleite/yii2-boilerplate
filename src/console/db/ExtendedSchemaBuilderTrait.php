<?php

namespace console\db;

use yii\db\ColumnSchemaBuilder;

trait ExtendedSchemaBuilderTrait
{
    /**
     * @return \yii\db\Connection the database connection to be used for schema building.
     */
    abstract protected function getDb();

    public function enum(array $properties): ColumnSchemaBuilder
    {
        return $this->getDb()->getSchema()->createColumnSchemaBuilder(Schema::TYPE_ENUM,
            implode(',', array_map(function ($value) {
                return sprintf("'%s'", $value);
            }, $properties)));
    }

    public function json(): ColumnSchemaBuilder
    {
        return $this->getDb()->getSchema()->createColumnSchemaBuilder(Schema::TYPE_JSON);
    }
}
