<?php

namespace console\db;

class Migration extends \yii\db\Migration
{
    use ExtendedSchemaBuilderTrait;

    const CASCADE = 'CASCADE';
    const RESTRICT = 'RESTRICT';
    const SET_NULL = 'SET NULL';
    const NO_ACTION = 'NO ACTION';
}