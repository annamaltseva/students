<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "visit".
 *
 * @property integer $id
 * @property string $date
 * @property integer $year_attestation_id
 * @property integer $group_id
 * @property integer $subject_id
 * @property string $rating
 * @property string $description
 * @property integer $user_id
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Group $group
 * @property Subject $subject
 * @property User $user
 * @property YearAttestation $yearAttestation
 * @property VisitResult[] $visitResults
 */
class Visit extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'visit';
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
            [['date', 'year_attestation_id', 'group_id', 'subject_id', 'rating', 'user_id'], 'required'],
            [['date'], 'safe'],
            [['year_attestation_id', 'group_id', 'subject_id', 'user_id', 'created_at', 'updated_at'], 'integer'],
            [['rating'], 'number'],
            [['description'], 'string', 'max' => 255],
            [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => Group::className(), 'targetAttribute' => ['group_id' => 'id']],
            [['subject_id'], 'exist', 'skipOnError' => true, 'targetClass' => Subject::className(), 'targetAttribute' => ['subject_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['year_attestation_id'], 'exist', 'skipOnError' => true, 'targetClass' => YearAttestation::className(), 'targetAttribute' => ['year_attestation_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => 'Дата лекции',
            'year_attestation_id' => 'Аттестация',
            'group_id' => 'Группа',
            'subject_id' => 'Предмет',
            'rating' => 'Балл за посещение',
            'description' => 'Примечание',
            'user_id' => 'User ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function beforeValidate() {
        $this->user_id = Yii::$app->user->identity->id;
        return parent::beforeValidate();
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getYearAttestation()
    {
        return $this->hasOne(YearAttestation::className(), ['id' => 'year_attestation_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVisitResults()
    {
        return $this->hasMany(VisitResult::className(), ['visit_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getYear()
    {
        return $this->hasOne(Year::className(), ['id' => 'year_id'])
            ->viaTable('year_attestation', ['id' => 'year_attestation_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttestation()
    {
        return $this->hasOne(Attestation::className(), ['id' => 'attestation_id'])
            ->viaTable('year_attestation', ['id' => 'year_attestation_id']);
    }
}