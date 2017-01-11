<?php

namespace Rgen3\GenderPrediction;

use Rgen3\GenderPrediction\Language\LanguageFabric;
use Rgen3\GenderPrediction\models\Predictor;

class Autocompleter
{
    protected $name;
    protected $language;

    protected static $availableTypes = ['first_name', 'last_name', 'middle_name'];

    public function setLanguage(string $language) : Autocompleter
    {
        $this->language = (new LanguageFabric())
            ->set($language)
            ->get();

        return $this;
    }

    public function setName(string $name) : Autocompleter
    {
        $this->name;
        return $this;
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function list(string $name) : array
    {
        return $this->language->autocomplete($name);
    }

    public static function getAvailableNameTypes() : array
    {
        return self::$availableTypes;
    }

    public static function isAvailableNameType(string $type) : bool
    {
        return in_array($type, self::getAvailableNameTypes());
    }
}