<?php

namespace api\controllers;

use api\rest\Controller;

class BoilerplateController extends Controller
{
    public function actionIndex(): array
    {
        return ['Hello' => 'World!'];
    }
}
