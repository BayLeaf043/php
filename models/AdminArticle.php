<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;


/**
 * This is the model class for table "articles".
 *
 * @property int $id
 * @property int $user_id
 * @property int $topic_id
 * @property string $title
 * @property string $content
 * @property string|null $image
 * @property string|null $tags
 * @property int $views
 * @property string $created_at
 * @property \yii\web\UploadedFile|null $imageFile
 *
 * @property Comments[] $comments
 * @property Topic $topic
 * @property User $user
 */
class AdminArticle extends \yii\db\ActiveRecord
{

    /** @var UploadedFile|null */
    public $imageFile;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'articles';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['image', 'tags'], 'default', 'value' => null],
            // файл зображення
            ['imageFile', 'file',
                'skipOnEmpty' => true,
                'extensions' => 'png, jpg, jpeg, gif',
                'maxSize' => 2 * 1024 * 1024, // 2MB
            ],
            [['views'], 'default', 'value' => 0],
            [['topic_id', 'title', 'content'], 'required'],
            [['user_id', 'topic_id', 'views'], 'integer'],
            [['content'], 'string'],
            [['created_at'], 'safe'],
            [['title', 'image', 'tags'], 'string', 'max' => 255],
            [['topic_id'], 'exist', 'skipOnError' => true, 'targetClass' => Topic::class, 'targetAttribute' => ['topic_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'topic_id' => 'Topic ID',
            'title' => 'Title',
            'content' => 'Content',
            'image' => 'Path to Image',
            'imageFile'  => 'Image',
            'tags' => 'Tags',
            'views' => 'Views',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[Comments]].
     *
     * @return \yii\db\ActiveQuery
     */
    //public function getComments()
    //{
        //return $this->hasMany(Comments::class, ['article_id' => 'id']);
    //}

    /**
     * Gets query for [[Topic]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTopic()
    {
        return $this->hasOne(Topic::class, ['id' => 'topic_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    // автозаповнення created_at і user_id
    public function beforeSave($insert)
    {
        if ($insert) {
            if (empty($this->created_at)) {
                $this->created_at = date('Y-m-d H:i:s');
            }
            if (Yii::$app->user && !Yii::$app->user->isGuest) {
                $this->user_id = Yii::$app->user->id;
            }
        }

        return parent::beforeSave($insert);
    }

    // допоміжний метод для збереження файлу
    public function uploadImage()
    {
        if ($this->imageFile instanceof UploadedFile) {
            $fileName = 'article_' . time() . '.' . $this->imageFile->extension;
            $path = Yii::getAlias('@webroot/uploads/') . $fileName;

            if ($this->imageFile->saveAs($path)) {
                // у БД зберігаємо відносний шлях
                $this->image = 'uploads/' . $fileName;
                return true;
            }
            return false;
        }
        return true; // якщо файл не вибрали — теж ок
    }

}
