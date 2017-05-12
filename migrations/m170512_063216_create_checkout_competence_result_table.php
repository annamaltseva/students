<?php

use yii\db\Migration;

/**
 * Handles the creation of table `checkout_competence_result`.
 * Has foreign keys to the tables:
 *
 * - `checkout_competence`
 * - `student`
 * - `competence_level`
 * - `user`
 */
class m170512_063216_create_checkout_competence_result_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('checkout_competence_result', [
            'id' => $this->primaryKey(),
            'checkout_competence_id' => $this->integer()->notNull(),
            'checkout_work_id' => $this->integer()->notNull(),
            'student_id' => $this->integer()->notNull(),
            'competence_level_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);

        // creates index for column `checkout_competence_id`
        $this->createIndex(
            'idx-checkout_competence_result-checkout_competence_id',
            'checkout_competence_result',
            'checkout_competence_id'
        );

        // add foreign key for table `checkout_competence`
        $this->addForeignKey(
            'fk-checkout_competence_result-checkout_competence_id',
            'checkout_competence_result',
            'checkout_competence_id',
            'checkout_competence',
            'id',
            'CASCADE'
        );


        // creates index for column `checkout_work_id`
        $this->createIndex(
            'idx-checkout_work_result-checkout_competence_id',
            'checkout_competence_result',
            'checkout_work_id'
        );

        // add foreign key for table `checkout_work`
        $this->addForeignKey(
            'fk-checkout_competence_result-checkout_work_id',
            'checkout_competence_result',
            'checkout_work_id',
            'checkout_work',
            'id',
            'CASCADE'
        );

        // creates index for column `student_id`
        $this->createIndex(
            'idx-checkout_competence_result-student_id',
            'checkout_competence_result',
            'student_id'
        );

        // add foreign key for table `student`
        $this->addForeignKey(
            'fk-checkout_competence_result-student_id',
            'checkout_competence_result',
            'student_id',
            'student',
            'id',
            'CASCADE'
        );

        // creates index for column `competence_level_id`
        $this->createIndex(
            'idx-checkout_competence_result-competence_level_id',
            'checkout_competence_result',
            'competence_level_id'
        );

        // add foreign key for table `competence_level`
        $this->addForeignKey(
            'fk-checkout_competence_result-competence_level_id',
            'checkout_competence_result',
            'competence_level_id',
            'competence_level',
            'id',
            'CASCADE'
        );

        // creates index for column `user_id`
        $this->createIndex(
            'idx-checkout_competence_result-user_id',
            'checkout_competence_result',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-checkout_competence_result-user_id',
            'checkout_competence_result',
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
        // drops foreign key for table `checkout_competence`
        $this->dropForeignKey(
            'fk-checkout_competence_result-checkout_competence_id',
            'checkout_competence_result'
        );

        // drops index for column `checkout_competence_id`
        $this->dropIndex(
            'idx-checkout_competence_result-checkout_competence_id',
            'checkout_competence_result'
        );

        // drops foreign key for table `checkout_work`
        $this->dropForeignKey(
            'fk-checkout_competence_result-checkout_work_id',
            'checkout_competence_result'
        );

        // drops index for column `checkout_work_id`
        $this->dropIndex(
            'idx-checkout_competence_result-checkout_work_id',
            'checkout_competence_result'
        );

        // drops foreign key for table `student`
        $this->dropForeignKey(
            'fk-checkout_competence_result-student_id',
            'checkout_competence_result'
        );

        // drops index for column `student_id`
        $this->dropIndex(
            'idx-checkout_competence_result-student_id',
            'checkout_competence_result'
        );

        // drops foreign key for table `competence_level`
        $this->dropForeignKey(
            'fk-checkout_competence_result-competence_level_id',
            'checkout_competence_result'
        );

        // drops index for column `competence_level_id`
        $this->dropIndex(
            'idx-checkout_competence_result-competence_level_id',
            'checkout_competence_result'
        );

        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-checkout_competence_result-user_id',
            'checkout_competence_result'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-checkout_competence_result-user_id',
            'checkout_competence_result'
        );

        $this->dropTable('checkout_competence_result');
    }
}
