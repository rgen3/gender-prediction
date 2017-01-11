<?php

namespace Rgen3\GenderPrediction\Language;

use Rgen3\GenderPrediction\Predictor;
use yii\db\Query;

class Russian extends AbstractLanguage
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
            return self::NOT_SET;

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

    private function getSex(string $string) : ?string
    {
        return (new Query())
            ->select('name, sex')
            ->from('tmp_names')
            ->where(['~*', 'name', "^$string$"])
            ->one()['sex'];

    }

    public function getDropdownItems() : array
    {
        return $this->dropdownItems;
    }

}