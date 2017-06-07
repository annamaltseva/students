<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "subject".
 *
 * @property integer $id
 * @property string $name
 * @property string $rating
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Checkout[] $checkouts
 */
class Subject extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'subject';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique', 'targetAttribute' => ['name']]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Наименование',
            'rating' => 'Балл за посещение',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCheckouts()
    {
        return $this->hasMany(Checkout::className(), ['subject_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserSubjects()
    {
        return $this->hasMany(UserSubject::className(), ['subject_id' => 'id']);
    }

    public static function getAll()
    {
        if (User::roleCurrentUser()=='admin') {
            $query = self::find()->orderBy(['name' => 'desc']);
        }
        else {
            $query = self::find()
                ->joinWith([
                    'userSubjects' => function ($query)  {
                        $query->onCondition(['user_subject.prepod_id' => Yii::$app->user->identity->id]);
                    },
                ], true, 'INNER JOIN')
                ->orderBy(['name' => 'desc']);
        }
        return $query->all();
    }
}
