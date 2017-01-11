<?php

class AutocompleterTest extends \PHPUnit_Framework_TestCase
{
    protected $existingName = 'Иван';
    protected $notExistingName = 'Аыдваывваы';
    protected $className;
    protected $ac;

    protected function setUp()
    {
        $this->className =
        $className       = '\\Rgen3\\GenderPrediction\\Autocompleter';

        $this->ac = new $className();
    }

    public function testIsAvailableNameType()
    {
        $className = $this->className;
        // Available
        $type = 'first_name';
        $this->assertTrue($className::isAvailableNameType($type));

        // Available
        $type = 'last_name';
        $this->assertTrue($className::isAvailableNameType($type));

        // Available
        $type = 'middle_name';
        $this->assertTrue($className::isAvailableNameType($type));

        // Not available
        $type = 'not_available_type';
        $this->assertFalse($className::isAvailableNameType($type));
    }

    public function testList()
    {
        $this->assertNotEmpty($this->ac->list($this->existingName));
    }


}