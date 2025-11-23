<?php

namespace app\models;

use yii\db\ActiveRecord;
use app\models\Article;

class Topic extends ActiveRecord
{
    public static function tableName()
    {
        return 'topics';
    }

    public function getArticles()
    {
        return $this->hasMany(Article::class, ['topic_id' => 'id']);
    }
}