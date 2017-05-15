<?php

use yii\db\Migration;

/**
 * Handles the creation of table `visit_result`.
 * Has foreign keys to the tables:
 *
 * - `visit`
 * - `student`
 * - `user`
 */
class m170515_094425_create_visit_result_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('visit_result', [
            'id' => $this->primaryKey(),
            'visit_id' => $this->integer()->notNull(),
            'student_id' => $this->integer()->notNull(),
            'rating' => $this->decimal(6,2)->notNull(),
            'user_id' => $this->integer()->notNull(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);

        // creates index for column `visit_id`
        $this->createIndex(
            'idx-visit_result-visit_id',
            'visit_result',
            'visit_id'
        );

        // add foreign key for table `visit`
        $this->addForeignKey(
            'fk-visit_result-visit_id',
            'visit_result',
            'visit_id',
            'visit',
            'id',
            'CASCADE'
        );

        // creates index for column `student_id`
        $this->createIndex(
            'idx-visit_result-student_id',
            'visit_result',
            'student_id'
        );

        // add foreign key for table `student`
        $this->addForeignKey(
            'fk-visit_result-student_id',
            'visit_result',
            'student_id',
            'student',
            'id',
            'CASCADE'
        );

        // creates index for column `user_id`
        $this->createIndex(
            'idx-visit_result-user_id',
            'visit_result',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-visit_result-user_id',
            'visit_result',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `visit`
        $this->dropForeignKey(
            'fk-visit_result-visit_id',
            'visit_result'
        );

        // drops index for column `visit_id`
        $this->dropIndex(
            'idx-visit_result-visit_id',
            'visit_result'
        );

        // drops foreign key for table `student`
        $this->dropForeignKey(
            'fk-visit_result-student_id',
            'visit_result'
        );

        // drops index for column `student_id`
        $this->dropIndex(
            'idx-visit_result-student_id',
            'visit_result'
        );

        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-visit_result-user_id',
            'visit_result'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-visit_result-user_id',
            'visit_result'
        );

        $this->dropTable('visit_result');
    }
}
