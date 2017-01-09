<?php

namespace Rgen3\GenderPrediction;

use Rgen3\GenderPrediction\Language\ILanguage;
use Rgen3\GenderPrediction\Language\LanguageException;

class Predictor
{
    const MALE = 0;
    const FEMALE = 1;
    const NOT_SET = 2;

    protected $lang;
    protected $langNamespace = (__NAMESPACE__ . "\\Language");

    public function checkLanguageClass(string $className)
    {
        if (!class_exists($this->getLangClassNamespaced($className)))
        {
            throw new LanguageException("Language class {$className} doesn't exists");
        }

        return $this;
    }

    public function setLanguage(string $lang) : Predictor
    {
        $this->checkLanguageClass($lang);
        $namespaced = $this->getLangClassNamespaced($lang);
        $this->lang = new $namespaced;
        return $this;
    }

    public function setLangClassNamespace(string $namespace)
    {
        $this->langNamespace = $namespace;
        return $this;
    }

    public function getLanguage() : ILanguage
    {
        return $this->lang;
    }

    public function getLangClassNamespace() : string
    {
        return $this->langNamespace;
    }

    public function getLangClassNamespaced(string $className) : string
    {
        $namespace = $this->getLangClassNamespace();
        return "{$namespace}\\{$className}";
    }

    public function getDropdownItems()
    {
        return $this->lang->getDropdownItems();
    }

    public function predict(string $name) : int
    {
        return $this->lang->setName($name)->predict();
    }

}