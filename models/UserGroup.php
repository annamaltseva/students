<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_group".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $prepod_id
 * @property integer $group_id
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Group $group
 * @property User $user
 */
class UserGroup extends AppActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_group';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['prepod_id', 'group_id'], 'required'],
            [['prepod_id', 'group_id', 'created_at', 'updated_at'], 'integer'],
            [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => Group::className(), 'targetAttribute' => ['group_id' => 'id']],
            [['prepod_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['prepod_id' => 'id']],
            [['prepod_id', 'group_id'], 'unique', 'targetAttribute' => ['prepod_id', 'group_id']]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'prepod_id' => 'User ID',
            'group_id' => 'Группа',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(Group::className(), ['id' => 'group_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
