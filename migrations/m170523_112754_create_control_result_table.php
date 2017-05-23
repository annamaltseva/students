<?php

use yii\db\Migration;

/**
 * Handles the creation of table `control_result`.
 * Has foreign keys to the tables:
 *
 * - `control`
 * - `student`
 * - `range`
 * - `user`
 */
class m170523_112754_create_control_result_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('control_result', [
            'id' => $this->primaryKey(),
            'control_id' => $this->integer()->notNull(),
            'student_id' => $this->integer()->notNull(),
            'range_id' => $this->integer()->notNull(),
            'score' => $this->decimal(6,2)->notNull(),
            'user_id' => $this->integer()->notNull(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);

        // creates index for column `control_id`
        $this->createIndex(
            'idx-control_result-control_id',
            'control_result',
            'control_id'
        );

        // add foreign key for table `control`
        $this->addForeignKey(
            'fk-control_result-control_id',
            'control_result',
            'control_id',
            'control',
            'id',
            'CASCADE'
        );

        // creates index for column `student_id`
        $this->createIndex(
            'idx-control_result-student_id',
            'control_result',
            'student_id'
        );

        // add foreign key for table `student`
        $this->addForeignKey(
            'fk-control_result-student_id',
            'control_result',
            'student_id',
            'student',
            'id',
            'CASCADE'
        );

        // creates index for column `range_id`
        $this->createIndex(
            'idx-control_result-range_id',
            'control_result',
            'range_id'
        );

        // add foreign key for table `range`
        $this->addForeignKey(
            'fk-control_result-range_id',
            'control_result',
            'range_id',
            'range',
            'id',
            'CASCADE'
        );

        // creates index for column `user_id`
        $this->createIndex(
            'idx-control_result-user_id',
            'control_result',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-control_result-user_id',
            'control_result',
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
        // drops foreign key for table `control`
        $this->dropForeignKey(
            'fk-control_result-control_id',
            'control_result'
        );

        // drops index for column `control_id`
        $this->dropIndex(
            'idx-control_result-control_id',
            'control_result'
        );

        // drops foreign key for table `student`
        $this->dropForeignKey(
            'fk-control_result-student_id',
            'control_result'
        );

        // drops index for column `student_id`
        $this->dropIndex(
            'idx-control_result-student_id',
            'control_result'
        );

        // drops foreign key for table `range`
        $this->dropForeignKey(
            'fk-control_result-range_id',
            'control_result'
        );

        // drops index for column `range_id`
        $this->dropIndex(
            'idx-control_result-range_id',
            'control_result'
        );

        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-control_result-user_id',
            'control_result'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-control_result-user_id',
            'control_result'
        );

        $this->dropTable('control_result');
    }
}
