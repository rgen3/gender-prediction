<?php

namespace Rgen3\GenderPrediction;

use Rgen3\GenderPrediction\Language\ILanguage;
use Rgen3\GenderPrediction\Language\LanguageFabric;

class Predictor
{
    const MALE = 0;
    const FEMALE = 1;
    const NOT_SET = 2;

    protected $lang;
    protected $fabric;

    public function __construct()
    {
        $this->fabric = new LanguageFabric();
    }

    public function setLanguage(string $lang) : Predictor
    {
        $this->lang = $this->fabric->set($lang)->get();
        return $this;
    }

    public function setLangClassNamespace(string $namespace) : Predictor
    {
        $this->fabric->setLangClassNamespace($namespace);
        return $this;
    }

    public function getLanguage() : ILanguage
    {
        return $this->lang;
    }

    public function getLangClassNamespace() : string
    {
        return $this->fabric->getLangClassNamespace();
    }

    public function getDropdownItems() : array
    {
        return $this->lang->getDropdownItems();
    }

    public function checkLanguageClass(string $className) : Predictor
    {
        $this->fabric->checkLanguageClass($className);

        return $this;
    }

    public function predict(string $name) : int
    {
        return $this->lang->setName($name)->predict();
    }

}