<?php

namespace Rgen3\GenderPrediction;

use yii\bootstrap\Dropdown;

class GenderInput extends Dropdown
{
    public $lang = 'Russian';

    public function init()
    {
        parent::init();

        $predictor = new Predictor();

    }
}