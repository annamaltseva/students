<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "control_result".
 *
 * @property integer $id
 * @property integer $control_id
 * @property integer $student_id
 * @property integer $range_id
 * @property string $score
 * @property integer $user_id
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Control $control
 * @property Range $range
 * @property Student $student
 * @property User $user
 */
class ControlResult extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'control_result';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['control_id', 'student_id', 'range_id', 'score', 'user_id'], 'required'],
            [['control_id', 'student_id', 'range_id', 'user_id', 'created_at', 'updated_at'], 'integer'],
            [['score'], 'number'],
            [['control_id'], 'exist', 'skipOnError' => true, 'targetClass' => Control::className(), 'targetAttribute' => ['control_id' => 'id']],
            [['range_id'], 'exist', 'skipOnError' => true, 'targetClass' => Range::className(), 'targetAttribute' => ['range_id' => 'id']],
            [['student_id'], 'exist', 'skipOnError' => true, 'targetClass' => Student::className(), 'targetAttribute' => ['student_id' => 'id']],
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
            'control_id' => 'Control ID',
            'student_id' => 'Student ID',
            'range_id' => 'Range ID',
            'score' => 'Score',
            'user_id' => 'User ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getControl()
    {
        return $this->hasOne(Control::className(), ['id' => 'control_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRange()
    {
        return $this->hasOne(Range::className(), ['id' => 'range_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudent()
    {
        return $this->hasOne(Student::className(), ['id' => 'student_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public static function getAll($controlID)
    {
        $result=[];

        $scores = ControlResult::find()->where(['control_id' => $controlID])->asArray()->all();
        foreach ($scores as $score) {
            $result[$score["control_id"]][$score["student_id"]] =[
                'range_id' =>$score["range_id"],
                'score' =>$score["score"]
            ];
        }
        return $result;
    }
}
