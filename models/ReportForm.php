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



    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

            [['year_id' ], 'required'],
            [['group_id', 'year_id', 'subject_id', 'rating_id'], 'integer'],

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
}
