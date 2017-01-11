<?php

namespace tests;

use Rgen3\GenderPrediction\Language\Russian\Language;

class LanguageObjectTest extends \PHPUnit_Framework_TestCase
{

    protected $male = "Иванов Иван Иванович";
    protected $female = "Иванова Мария Ивановна";
    protected $notSet = "theveryrandomstr2347fshj";

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
    }

    public function testNameExploding()
    {
        $lang = new Language();
        $lang->setName($this->male);
        $this->assertNotEmpty($lang->getName(), print_r($lang->getName(), true));
    }

    public function testIsMethod()
    {
        $lang = new Russian();
        // is male
        $lang->setName($this->male);
        $gender = $lang->is();
        $this->assertEquals($lang::MALE, $gender);
        // is female
        $lang->setName($this->female);
        $gender = $lang->is();
        $this->assertEquals($lang::FEMALE, $gender);
        // is not set
        $lang->setName($this->notSet);
        $gender = $lang->is();
        $this->assertEquals($lang::NOT_SET, $gender, "Current name is " . print_r($lang->getName(), true));
    }
}