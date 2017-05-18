<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;


/**
 * This is the model class for table "visit_result".
 *
 * @property integer $id
 * @property integer $visit_id
 * @property integer $student_id
 * @property string $rating
 * @property integer $user_id
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Student $student
 * @property User $user
 * @property Visit $visit
 */
class VisitResult extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'visit_result';
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
            [['visit_id', 'student_id', 'rating', 'user_id'], 'required'],
            [['visit_id', 'student_id', 'user_id', 'created_at', 'updated_at'], 'integer'],
            [['rating'], 'number'],
            [['student_id'], 'exist', 'skipOnError' => true, 'targetClass' => Student::className(), 'targetAttribute' => ['student_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['visit_id'], 'exist', 'skipOnError' => true, 'targetClass' => Visit::className(), 'targetAttribute' => ['visit_id' => 'id']],
            [['visit_id', 'student_id'], 'unique', 'targetAttribute' => ['visit_id', 'student_id']]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'visit_id' => 'Visit ID',
            'student_id' => 'Студент',
            'rating' => 'Rating',
            'user_id' => 'User ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVisit()
    {
        return $this->hasOne(Visit::className(), ['id' => 'visit_id']);
    }

    public static function getSumAll($controlID)
    {
        $result=[];

        $sql = 'SELECT student_id, sum(visit_result.rating) as score FROM visit  '.
            'LEFT JOIN visit_result ON visit.id = visit_result.visit_id WHERE control_id='.$controlID.' GROUP BY student_id';

        $visits = Yii::$app->db->createCommand($sql);
        $visits = $visits->queryAll();

        foreach ($visits as $visit) {
           $result[$visit["student_id"]] =$visit["score"];
        }
        return $result;
    }

    public static function getAll($controlID)
    {
        $result=[];

        $visits = Visit::find()->where(['control_id'=>$controlID])->all();
        foreach ($visits as $visit) {
            $visitResults = self::find()->where(['visit_id' => $visit->id])->all();
            foreach ($visitResults as $visitResult) {
                $result[$visitResult->student_id][$visitResult->visit_id] =$visitResult->rating;
            }
        }
        return $result;
    }
}
