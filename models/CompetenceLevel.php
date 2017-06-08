<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "competence_level".
 *
 * @property integer $id
 * @property string $name
 * @property integer $level_value
 * @property integer $order_field
 * @property integer $created_at
 * @property integer $updated_at
 */
class CompetenceLevel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'competence_level';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'level_value'], 'required'],
            [['level_value', 'order_field', 'created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['level_value'], 'unique', 'targetAttribute' => ['level_value']]
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
            'level_value' => 'Значение',
            'order_field' => 'Order Field',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public static function getAll()
    {
        $query = self::find();
        return $query->all();
    }

    public static function getScore()
    {
        $result = [];
        $data= self::getAll();
        $result["0"]=['data-score' => '0'];
        foreach($data  as $key => $item ){
            $result[$item["id"]] = ['data-score' => $item["level_value"]]  ;
        }

        return $result;
    }

}
