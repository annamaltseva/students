<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "control_status".
 *
 * @property integer $id
 * @property string $name
 *
 * @property Control[] $controls
 */
class ControlStatus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'control_status';
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
        return $this->hasMany(Control::className(), ['control_status_id' => 'id']);
    }
}
