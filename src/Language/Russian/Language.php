<?php

namespace Rgen3\GenderPrediction\Language\Russian;

use Rgen3\GenderPrediction\Language\AbstractLanguage;
use Rgen3\GenderPrediction\Language\ILanguage;
use Rgen3\GenderPrediction\Predictor;
use yii\db\Query;

class Language extends AbstractLanguage
{
    private $dropdownItems = [
        Predictor::MALE => 'Мужчина',
        Predictor::FEMALE => 'Женщина',
        Predictor::NOT_SET => 'Не определено'
    ];

    public function predict() : int
    {
        $name = $this->getName();

        foreach ($name as $item)
        {
            $sex = $this->getSex($item);

            if ($sex)
                break;
        }

        if (is_null($sex))
        {
            return self::NOT_SET;
        }

        return [
            'm' => self::MALE,
            'f' => self::FEMALE
        ][$sex];
    }

    public function setDropdownItems(array $items): ILanguage
    {
        $this->dropdownItems = $items;
        return $this;
    }

    private function byEnding(array $array)
    {
        if (!empty(preg_grep('#[ая]$#i', $array)))
        {
            return Predictor::FEMALE;
        }

        return Predictor::MALE;

    }

    private function getSex(string $string) : ?string
    {
        $row = (new Query())
            ->select('sex')
            ->from('tmp_names')
            ->where(['~*', 'name', "{$string}"])
            ->one();

        return $row['sex'] ?? null;

    }

    public function getDropdownItems() : array
    {
        return $this->dropdownItems;
    }

}