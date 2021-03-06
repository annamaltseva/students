<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "group".
 *
 * @property integer $id
 * @property string $name
 * @property integer $user_id
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property User $user
 * @property Student[] $students
 */
class Group extends AppActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'group';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'user_id'], 'required'],
            [['user_id', 'created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
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
            'user_id' => 'User ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }


    public function afterSave($insert, $changedAttributes)
    {
        if ($insert) {
            if (User::roleCurrentUser()!='admin') {

                $userGroup = new UserGroup();
                $userGroup->group_id = $this->id;
                $userGroup->prepod_id = Yii::$app->user->identity->id;
                $userGroup->save();
            }
        }
        parent::afterSave($insert, $changedAttributes);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudents()
    {
        return $this->hasMany(Student::className(), ['group_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserGroups()
    {
        return $this->hasMany(UserGroup::className(), ['group_id' => 'id']);
    }

    public static function getAll()
    {
        if (User::roleCurrentUser()=='admin') {
            $query = self::find()->orderBy(['name' => 'desc']);
        }
        else {
            $query = self::find()
                ->joinWith([
                    'userGroups' => function ($query)  {
                        $query->onCondition(['user_group.prepod_id' => Yii::$app->user->identity->id]);
                    },
                ], true, 'INNER JOIN')
                ->orderBy(['name' => 'desc']);
        }

        return $query->all();
    }
    public static function getAllProvider()
    {
        if (User::roleCurrentUser()=='admin') {
            $query = self::find();
        }
        else {
            $query = self::find()
                ->joinWith([
                    'userGroups' => function ($query)  {
                        $query->onCondition(['user_group.prepod_id' => Yii::$app->user->identity->id]);
                    },
                ], true, 'INNER JOIN');
        }

        return $query;
    }
}
