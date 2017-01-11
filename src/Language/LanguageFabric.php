<?php

namespace Rgen3\GenderPrediction\Language;

class LanguageFabric
{
    protected $lang;

    public function set($language)
    {
        $this->checkLanguageClass($language);
        $namespaced = $this->getLangClassNamespaced($language);
        $this->lang = new $namespaced;

        return $this;
    }

    public function setLangClassNamespace(string $namespace) : LanguageFabric
    {
        $this->langNamespace = $namespace;
        return $this;
    }

    public function get() : ILanguage
    {
        return $this->lang;
    }

    public function getLangClassNamespace() : string
    {
        return __NAMESPACE__;
    }

    public function getLangClassNamespaced(string $className) : string
    {
        $namespace = $this->getLangClassNamespace();
        return "{$namespace}\\{$className}\\Language";
    }

    public function checkLanguageClass(string $className) : LanguageFabric
    {
        if (!class_exists($this->getLangClassNamespaced($className)))
        {
            $className = $this->getLangClassNamespaced($className);
            throw new LanguageException("Language class {$className} doesn't exists");
        }

        return $this;
    }
}