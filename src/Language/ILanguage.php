<?php

namespace Rgen3\GenderPrediction\Language;

interface ILanguage
{

    public function predict() : int;

    public function setDropdownItems(array $items) : ILanguage;

    public function getDropdownItems(): array;

}