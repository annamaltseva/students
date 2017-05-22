<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "goal".
 *
 * @property integer $id
 * @property string $name
 *
 * @property Control[] $controls
 */
class Goal extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'goal';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
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
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getControls()
    {
        return $this->hasMany(Control::className(), ['goal_id' => 'id']);
    }

    public static function getAll()
    {
        $query = self::find();
        return $query->all();
    }
}
