<?php

namespace Rgen3\GenderPrediction\controllers;

use Rgen3\GenderPrediction\Autocompleter;
use yii\rest\Controller;
use yii\web\Response;

class GenderPredictionController extends Controller
{

    public function beforeAction($action)
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        return parent::beforeAction($action); // TODO: Change the autogenerated stub
    }

    public function actionIndex()
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        return [
            ['label' => 'title 1'],
            ['label' => 'title 2'],
            ['label' => 'title 3'],
        ];
    }

    public function actionAutocomplete()
    {
        $term = \Yii::$app->request->get('term', false);
        $type = \Yii::$app->request->get('type', false);

        $list = (new Autocompleter())
            ->setLanguage('Russian')
            ->list($term);

        return $list;
    }

}