<?php

use yii\db\Migration;

/**
 * Handles the creation of table `control_attestation_result`.
 * Has foreign keys to the tables:
 *
 * - `control_attestation`
 * - `student`
 * - `user`
 */
class m170529_113339_create_control_attestation_result_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('control_attestation_result', [
            'id' => $this->primaryKey(),
            'control_attestation_id' => $this->integer()->notNull(),
            'student_id' => $this->integer()->notNull(),
            'score' => $this->decimal(6,2)->notNull(),
            'user_id' => $this->integer()->notNull(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);

        // creates index for column `control_attestation_id`
        $this->createIndex(
            'idx-control_attestation_result-control_attestation_id',
            'control_attestation_result',
            'control_attestation_id'
        );

        // add foreign key for table `control_attestation`
        $this->addForeignKey(
            'fk-control_attestation_result-control_attestation_id',
            'control_attestation_result',
            'control_attestation_id',
            'control_attestation',
            'id',
            'CASCADE'
        );

        // creates index for column `student_id`
        $this->createIndex(
            'idx-control_attestation_result-student_id',
            'control_attestation_result',
            'student_id'
        );

        // add foreign key for table `student`
        $this->addForeignKey(
            'fk-control_attestation_result-student_id',
            'control_attestation_result',
            'student_id',
            'student',
            'id',
            'CASCADE'
        );

        // creates index for column `user_id`
        $this->createIndex(
            'idx-control_attestation_result-user_id',
            'control_attestation_result',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-control_attestation_result-user_id',
            'control_attestation_result',
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
        // drops foreign key for table `control_attestation`
        $this->dropForeignKey(
            'fk-control_attestation_result-control_attestation_id',
            'control_attestation_result'
        );

        // drops index for column `control_attestation_id`
        $this->dropIndex(
            'idx-control_attestation_result-control_attestation_id',
            'control_attestation_result'
        );

        // drops foreign key for table `student`
        $this->dropForeignKey(
            'fk-control_attestation_result-student_id',
            'control_attestation_result'
        );

        // drops index for column `student_id`
        $this->dropIndex(
            'idx-control_attestation_result-student_id',
            'control_attestation_result'
        );

        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-control_attestation_result-user_id',
            'control_attestation_result'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-control_attestation_result-user_id',
            'control_attestation_result'
        );

        $this->dropTable('control_attestation_result');
    }
}
