<?php

namespace app\models;

use yii\db\ActiveRecord;
use app\models\Topic;

class Article extends ActiveRecord
{
    public static function tableName()
    {
        return 'articles';
    }

    public function getTopic()
    {
        return $this->hasOne(Topic::class, ['id' => 'topic_id']);
    }
}