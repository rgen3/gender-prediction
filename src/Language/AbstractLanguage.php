<?php

namespace Rgen3\GenderPrediction\Language;

use Rgen3\GenderPrediction\Predictor;
use \Rgen3\GenderPrediction\models\Predictor as MPredictor;

abstract class AbstractLanguage implements ILanguage
{
    const MALE = 0;
    const FEMALE = 1;
    const NOT_SET = 2;

    private $name;
    private $predicted = null;

    public function autocomplete(string $name) : array
    {
        $model = new MPredictor();
        $list = $model->getNameList($name, $this->currentLanguage());

        if (!$list)
        {
            $list = $this->emptyAutocompleteList();
        }

        return $list;
    }

    public final function setName(string $string) : ILanguage
    {
        try
        {
            $this->name = $this->explode($string);
            if (empty($this->name))
            {
                throw new \Exception("Unable to preg_split");
            }
        }
        catch (\Exception $e)
        {
            $this->name = [false];
        }

        return $this;
    }

    public final function getName() : array
    {
        return $this->name;
    }

    public function is()
    {
        if ($this->getName() === [false])
        {
            return self::NOT_SET;
        }

        return $this->predict();
    }

    public abstract function predict() : int;

    public function emptyAutocompleteList(): array
    {
        return [];
    }

    protected function explode(string $string): array
    {
        return preg_split('#[\s-]+#', $string, -1, PREG_SPLIT_NO_EMPTY);
    }

}