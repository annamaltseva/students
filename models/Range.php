<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "range".
 *
 * @property integer $id
 * @property integer $control_id
 * @property string $rating
 * @property string $description
 * @property string $start_rating
 * @property string $end_rating
 * @property integer $user_id
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Control $control
 * @property User $user
 */
class Range extends AppActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'range';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['control_id', 'rating', 'description', 'start_rating', 'user_id'], 'required'],
            [['control_id', 'user_id', 'created_at', 'updated_at'], 'integer'],
            [['start_rating', 'end_rating'], 'number'],
            [['rating', 'description'], 'string', 'max' => 255],
            [['control_id'], 'exist', 'skipOnError' => true, 'targetClass' => Control::className(), 'targetAttribute' => ['control_id' => 'id']],
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
            'rating' => 'Оценка',
            'description' => 'Описание',
            'start_rating' => 'Минимальный балл',
            'end_rating' => 'Максимальный балл',
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
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public static function getAll($controlID)
    {
        $query = self::find()->where(['control_id' =>$controlID])->orderBy(['start_rating'=>'desc']);
        return $query->all();
    }

}
