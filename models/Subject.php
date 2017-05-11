<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "subject".
 *
 * @property integer $id
 * @property string $name
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

    public static function getAll()
    {
        $query = self::find()->orderBy(['name'=>'desc']);
        return $query->all();
    }
}
