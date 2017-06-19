<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "control_attestation_report".
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
class ControlAttestationReport extends AppActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'control_attestation_report';
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

    public static function createReportDataQuantity($control_id)
    {
        $actionResult = true;
        $controlAttestations = ControlAttestation::find()->joinWith('control')->where(['control_id' =>$control_id, 'control.rating_id' =>1])->all();
        foreach ($controlAttestations as $controlAttestation) {
            $strSql ='SELECT z.control_attestation_id, z.student_id,round((sum(z.count_work_student)/sum(z.count_work))*100,2) score
                        FROM
                        (
                            SELECT
                            t.control_attestation_id,t.student_id, t.quantity count_work,count(t.kol) count_work_student
                            FROM
                            (
                            select c.subject_id, c.group_id, ca.id as control_attestation_id,ck.id checkout_id,ck.quantity,st.id student_id, cr.student_id as kol, st.name as student_name
                            from control c
                            Inner JOIN control_attestation ca ON c.id=ca.control_id
                            INNER JOIN attestation a ON ca.attestation_id = a.id
                            INNER JOIN checkout ck on ca.id=ck.control_attestation_id
                            INNER JOIN student st ON c.group_id = st.group_id
                            LEFT JOIN checkout_result cr ON ck.id=cr.checkout_id and st.id = cr.student_id
                            where
                            ca.id= '.$controlAttestation->id.'
                            ) t
                            GROUP BY t.control_attestation_id,t.checkout_id,t.quantity,t.student_id
                        ) as z
                        GROUP BY z.control_attestation_id, z.student_id';


            $results = Yii::$app->db->createCommand($strSql)->queryAll();
            foreach($results as $result) {
                $report = ControlAttestationReport::find()->where(['control_attestation_id' =>$result["control_attestation_id"], 'student_id'=>$result["student_id"]])->one();
                if (is_null($report)) {
                    $report = new ControlAttestationReport();
                }
                $report->student_id = $result["student_id"];
                $report->score = $result["score"];
                $report->control_attestation_id =$result["control_attestation_id"];
                if (!$report->save()) {$actionResult = false;}
            }
        }

        return $actionResult;
    }

    public static function createReportDataQuality($control_id)
    {
        $actionResult = true;
        $controlAttestations = ControlAttestation::find()->joinWith('control')->where(['control_id' =>$control_id, 'control.rating_id' =>2])->all();
        foreach ($controlAttestations as $controlAttestation) {
            $strSql ='SELECT
                a.control_attestation_id, a.student_id, round((sum(a.count_work_student_real)/sum(a.count_work))*100,2) score
                FROM
                (    SELECT
                    f.control_attestation_id,
                    f.student_id, f.checkout_id,
                    f.count_work, sum(f.count_work_student_real) count_work_student_real

                    FROM
                    (
                        select
                        p.*,
                        case
                            WHEN kol_comp =count_work_student
                            then 1 ELSE  0
                        END as count_work_student_real

                        from
                        (
                            SELECT z.*,
                            st.id as student_id ,  count(ccr.id) as count_work_student
                            FROM
                            (
                                SELECT t.control_attestation_id,t.control_id, t.checkout_id, t.count_work, t.count_work_fact,cw.id work_id, count(cwc.id) as kol_comp FROM
                                (
                                    SELECT ca.id as control_attestation_id, ca.control_id, ck.id as checkout_id,ck.quantity as count_work,count(cw.id) count_work_fact
                                    FROM control_attestation ca
                                    INNER JOIN checkout ck on ca.id=ck.control_attestation_id
                                    INNER JOIN checkout_work cw ON ck.id=cw.checkout_id
                                    WHERE ca.id= '.$controlAttestation->id.'
                                    GROUP BY  ca.id, ca.control_id,ck.id,ck.quantity
                                ) as t
                                INNER JOIN checkout_work cw ON t.checkout_id=cw.checkout_id
                                INNER JOIN checkout_work_competence cwc ON cw.id=cwc.checkout_work_id
                                GROUP BY t.control_attestation_id, t.control_id, t.checkout_id, t.count_work, t.count_work_fact,cw.id
                            ) as z

                            INNER JOIN control c ON z.control_id = c.id and c.rating_id=2
                            INNER JOIN student st ON c.group_id = st.group_id
                            LEFT JOIN checkout_competence_result ccr on z.work_id = ccr.checkout_work_id AND st.id=ccr.student_id
                            GROUP BY
                            z.control_attestation_id, z.control_id, z.checkout_id, z.count_work, z.count_work_fact,z.work_id, z.kol_comp, st.id
                        ) as p
                    ) as f
                    GROUP BY f.control_attestation_id,
                    f.student_id,
                    f.checkout_id,
                    f.count_work
                ) as a
                GROUP BY
                a.control_attestation_id, a.student_id';

            $results = Yii::$app->db->createCommand($strSql)->queryAll();
            foreach($results as $result) {
                $report = ControlAttestationReport::find()->where(['control_attestation_id' =>$result["control_attestation_id"], 'student_id'=>$result["student_id"]])->one();
                if (is_null($report)) {
                    $report = new ControlAttestationReport();
                }
                $report->student_id = $result["student_id"];
                $report->score = $result["score"];
                $report->control_attestation_id =$result["control_attestation_id"];
                if (!$report->save()) {$actionResult = false;}
            }
        }

        return $actionResult;
    }

    public static function getReportData($filter)
    {
        $year_id =$filter['year_id'];
        $group_id =$filter['group_id'];
        $rating_id =$filter['rating_id'];
        $subject_id =$filter['subject_id'];

        $strWhere ='';
        $strJoin =' LEFT ';
        if ($group_id!='') $strWhere .=' AND c.group_id ='.$group_id;
        if ($rating_id!='') {
            if ($rating_id==1) {
                $strWhere .= ' AND IFNULL(car.score,-1) <=15';
            }
            if ($rating_id==2) {
                $strWhere .= ' AND IFNULL(car.score,-1) >15';
            }
            $strJoin =' INNER ';
        }
        if ($subject_id!='') $strWhere .=' AND c.subject_id ='.$subject_id;

        $group =[];
        $subject =[];
        $attestation=[];
        $student =[];
        $data =[];

        $strSql = 'SELECT distinct ca.attestation_id,
            a.name as attestation_name
            FROM control c
            INNER JOIN control_attestation ca ON c.id=ca.control_id
            INNER JOIN attestation a on ca.attestation_id=a.id
            INNER JOIN `group` g on c.group_id=g.id
            INNER JOIN student st ON g.id=st.group_id
            '.$strJoin.' JOIN control_attestation_report car on ca.id =car.control_attestation_id and st.id=car.student_id
            WHERE year_id='.$year_id.$strWhere.'
            order by a.id';



        $results = Yii::$app->db->createCommand($strSql)->queryAll();
        foreach ($results as $result) {
            $attestation[]=[
                'id' => $result["attestation_id"],
                'name' => $result["attestation_name"]
            ];
        }

        $strSql = 'SELECT  distinct c.group_id, g.name as group_name
            FROM control c
            INNER JOIN control_attestation ca ON c.id=ca.control_id
            INNER JOIN attestation a on ca.attestation_id=a.id
            INNER JOIN `group` g on c.group_id=g.id
            INNER JOIN student st ON g.id=st.group_id
            '.$strJoin.' JOIN control_attestation_report car on ca.id =car.control_attestation_id and st.id=car.student_id
            WHERE year_id='.$year_id.$strWhere.'
            order by group_name';



        $results = Yii::$app->db->createCommand($strSql)->queryAll();
        foreach ($results as $result) {
            $group[] =[
                'id' =>$result["group_id"],
                'name' => $result["group_name"]
            ];
        }


        $strSql = 'SELECT DISTINCT  ca.attestation_id, c.group_id, c.subject_id, s.name as subject_name
            FROM control c
            INNER JOIN control_attestation ca ON c.id=ca.control_id
            INNER JOIN attestation a on ca.attestation_id=a.id
            INNER join `subject` s on c.subject_id= s.id
            INNER JOIN `group` g on c.group_id=g.id
            INNER JOIN student st ON g.id=st.group_id
            '.$strJoin.' JOIN control_attestation_report car on ca.id =car.control_attestation_id and st.id=car.student_id

            WHERE year_id='.$year_id.$strWhere.'
            order by subject_name, g.name, a.id';

        $results = Yii::$app->db->createCommand($strSql)->queryAll();
        foreach ($results as $result) {
            $subject[$result["attestation_id"]][$result["group_id"]][] =[
                'id' =>$result["subject_id"],
               'name' => $result["subject_name"]
             ];
        }




        $strSql = 'select
            c.subject_id, c.group_id,ca.attestation_id,
            a.name as attestation_name,g.name as group_name, st.id as student_id, s.name as subject_name,
            st.name, IFNULL(car.score,-1) score
            from control c
            INNER JOIN control_attestation ca ON c.id=ca.control_id
            INNER JOIN attestation a on ca.attestation_id=a.id
            INNER join `subject` s on c.subject_id= s.id
            INNER JOIN `group` g on c.group_id=g.id
            INNER JOIN student st ON g.id=st.group_id
            '.$strJoin.' JOIN control_attestation_report car on ca.id =car.control_attestation_id and st.id=car.student_id
            WHERE year_id='.$year_id.$strWhere.'
            ORDER BY group_id,ca.attestation_id,st.name,s.name
            ';

        $results = Yii::$app->db->createCommand($strSql)->queryAll();
        foreach ($results as $result) {
            $data[$result["group_id"]][$result["attestation_id"]][$result["student_id"]][$result["subject_id"]]=$result["score"];
        }


        $strSql = 'SELECT
            distinct c.group_id, st.id, st.name

            FROM control c
            INNER JOIN control_attestation ca ON c.id=ca.control_id
            INNER JOIN attestation a on ca.attestation_id=a.id
            INNER join `subject` s on c.subject_id= s.id
            INNER JOIN `group` g on c.group_id=g.id
            INNER JOIN student st ON g.id=st.group_id
            '.$strJoin.' JOIN control_attestation_report car on ca.id =car.control_attestation_id and st.id=car.student_id
            WHERE year_id='.$year_id.$strWhere.'
            order by c.group_id,  st.name';

        $results = Yii::$app->db->createCommand($strSql)->queryAll();
        foreach ($results as $result) {
            $student[$result["group_id"]][] =[
                'id' =>$result["id"],
                'name' => $result["name"]
            ];
        }


        $result=[];
        $result["group"] =$group;
        $result["subject"] =$subject;
        $result["attestation"] =$attestation;
        $result["student"] =$student;
        $result["data"] = $data;

        return $result;
    }

}
