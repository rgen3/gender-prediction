<?php

namespace Rgen3\GenderPrediction\models;

use yii\base\Model;
use yii\db\Query;

class Predictor extends Model
{
    public static function getTableName()
    {
        return 'tmp_names';
    }

    public function getSex(string $string, string $language = 'Russian') : ?string
    {
        $row = (new Query())
            ->select('sex')
            ->from(self::getTableName())
            ->where(['~*', 'name', "{$string}"])
            ->one();

        return $row['sex'] ?? null;
    }

    public function getNameList(string $name, string $type, $limit = 25) : array
    {
        $rows = (new Query())
            ->select('name as label')
            ->from(self::getTableName())
            ->where(['~*', 'name', "^{$name}"])
            //->andWhere(['type', $type])
            ->limit($limit)
            ->all();

        return $rows;
    }
}