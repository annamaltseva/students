<?php
namespace app\models;

use yii\base\Model;


/**
 * Report form
 */
class ReportForm extends Model
{
    public $year_id;
    public $group_id;
    public $subject_id;
    public $rating_id;
    public $view_type;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

            [['year_id','view_type' ], 'required'],
            [['group_id', 'year_id', 'subject_id', 'rating_id', 'view_type'], 'integer'],

        ];
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'year_id' => 'Год',
            'group_id' => 'Группа',
            'subject_id' => 'Предмет',
            'rating_id' => 'Успеваемость',
            'view_type' => 'Формат',
        ];
    }

    public static function getRating()
    {
        $result =[
            ['id'=>1, 'name' =>'Не справился c учёбой'],
            ['id'=>2, 'name' =>'Справился c учёбой'],
        ];

        return $result;
    }

    public static function getView()
    {
        $result =[
            ['id'=>1, 'name' =>'Html'],
            ['id'=>2, 'name' =>'Excel'],
        ];

        return $result;
    }

}
