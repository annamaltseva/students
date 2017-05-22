<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "control".
 *
 * @property integer $id
 * @property integer $year_attestation_id
 * @property integer $group_id
 * @property integer $subject_id
 * @property integer $rating_id
 * @property string $limit_rating
 * @property integer $user_id
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Group $group
 * @property Rating $rating
 * @property Subject $subject
 * @property User $user
 * @property YearAttestation $yearAttestation
 */
class Control extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'control';
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
            [['year_attestation_id', 'group_id', 'subject_id', 'rating_id', 'limit_rating', 'user_id'], 'required'],
            [['year_attestation_id', 'group_id', 'subject_id', 'rating_id', 'user_id', 'created_at', 'updated_at'], 'integer'],
            [['limit_rating'], 'number'],
            [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => Group::className(), 'targetAttribute' => ['group_id' => 'id']],
            [['rating_id'], 'exist', 'skipOnError' => true, 'targetClass' => Rating::className(), 'targetAttribute' => ['rating_id' => 'id']],
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
            'year_attestation_id' => 'Аттестация',
            'group_id' => 'Группа',
            'subject_id' => 'Предмет',
            'rating_id' => 'Метод оценки',
            'limit_rating' => 'Минимальный балл',
            'user_id' => 'Создал',
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
    public function getRating()
    {
        return $this->hasOne(Rating::className(), ['id' => 'rating_id']);
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

    static public function getCheckoutWorkAll($control_id)
    {
        $result =[];
        $checkoutArr =[];
        $workArr =[];
        $competenceArr =[];
        $checkouts = Checkout::find()->with('checkoutForm')->where(['control_id' => $control_id])->all();
        foreach ($checkouts as $checkout) {
            $checkoutArr[] = [
                'id' => $checkout->id,
                'name' => $checkout->checkoutForm->name,
                'quantity' => $checkout->quantity
            ];
            $works = CheckoutWork::find()->where(['checkout_id' => $checkout->id])->all();
            foreach ($works as $work) {
                $workArr[$checkout->id][] =[
                    'id' =>$work->id, 'name' =>$work->name
                ];

                $competences = CheckoutWorkCompetence::find()->with('checkoutCompetence')->where(['checkout_work_id' => $work->id])->all();
                foreach ($competences as $competence) {
                    $competenceArr[$checkout->id][$work->id][] =[
                        'id' => $competence->checkout_competence_id,
                        'name' =>$competence->checkoutCompetence->name
                    ];
                }

            }
        }
        $result["checkout"] = $checkoutArr;
        $result["work"] = $workArr;
        $result["competence"] = $competenceArr;
        return $result;
    }

}
