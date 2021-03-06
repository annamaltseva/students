<?php

namespace app\models;

use Yii;


/**
 * This is the model class for table "user_subject".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $prepod_id
 * @property integer $subject_id
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Subject $subject
 * @property User $user
 */
class UserSubject extends AppActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_subject';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['prepod_id', 'subject_id'], 'required'],
            [['prepod_id', 'subject_id', 'created_at', 'updated_at'], 'integer'],
            [['user_id', 'subject_id'], 'unique', 'targetAttribute' => ['user_id', 'subject_id']],
            [['subject_id'], 'exist', 'skipOnError' => true, 'targetClass' => Subject::className(), 'targetAttribute' => ['subject_id' => 'id']],
            [['prepod_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['prepod_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'subject_id' => 'Предмет',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubject()
    {
        return $this->hasOne(Subject::className(), ['id' => 'subject_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
