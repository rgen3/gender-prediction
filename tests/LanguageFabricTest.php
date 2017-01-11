<?php

namespace tests;

use Rgen3\GenderPrediction\Language\ILanguage;
use Rgen3\GenderPrediction\Language\LanguageException;
use Rgen3\GenderPrediction\Language\LanguageFabric;
use Rgen3\GenderPrediction\Predictor;

class LanguageFabricTest extends \PHPUnit_Framework_TestCase
{
    protected $existingLangClass = 'Russian';
    protected $notExistingLangClass = 'Ololo';

    protected $lang;
    protected $fabric;

    public function setUp()
    {
        $this->fabric = new LanguageFabric();
    }

    public function testCheckLanguageClass()
    {
        try
        {
            // not expecting exception
            $class = $this->existingLangClass;
            $this->fabric->checkLanguageClass($class);
        }
        catch(\Exception $e)
        {
            $this->fail();
        }

        // Exception
        $class = $this->notExistingLangClass;
        $this->expectException(LanguageException::class);
        $this->fabric->checkLanguageClass($class);
    }

    /**
     * @depends testCheckLanguageClass
     */
    public function testSet()
    {

        $this->expectException(LanguageException::class);
        $this->fabric->set($this->notExistingLangClass);

        try
        {
            $this->fabric->set($this->existingLangClass);
        }
        catch (LanguageException $e)
        {
            $this->fail($e->getMessage());
        }

    }

    /**
     * @depends testSet
     */
    public function testGet()
    {
        $lang = $this->fabric->set($this->existingLangClass)->get();
        $this->assertInstanceOf(ILanguage::class, $lang);
    }
}