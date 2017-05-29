<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "control_attestation_result".
 *
 * @property integer $id
 * @property integer $control_attestation_id
 * @property integer $student_id
 * @property string $score
 * @property integer $user_id
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property ControlAttestation $controlAttestation
 * @property Student $student
 * @property User $user
 */
class ControlAttestationResult extends AppActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'control_attestation_result';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['control_attestation_id', 'student_id', 'score', 'user_id'], 'required'],
            [['control_attestation_id', 'student_id', 'user_id', 'created_at', 'updated_at'], 'integer'],
            [['score'], 'number'],
            [['control_attestation_id'], 'exist', 'skipOnError' => true, 'targetClass' => ControlAttestation::className(), 'targetAttribute' => ['control_attestation_id' => 'id']],
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
            'control_attestation_id' => 'Control Attestation ID',
            'student_id' => 'Student ID',
            'score' => 'Score',
            'user_id' => 'User ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getControlAttestation()
    {
        return $this->hasOne(ControlAttestation::className(), ['id' => 'control_attestation_id']);
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

    public static function getAll($controlAttestationID)
    {
        $result=[];

        $scores = self::find()->where(['control_attestation_id' => $controlAttestationID])->asArray()->all();
        foreach ($scores as $score) {
            $result[$score["student_id"]] = $score["score"];
        }
        return $result;
    }
}
