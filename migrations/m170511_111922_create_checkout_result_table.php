<?php

use yii\db\Migration;

/**
 * Handles the creation of table `checkout_result`.
 * Has foreign keys to the tables:
 *
 * - `checkout`
 * - `student`
 * - `user`
 */
class m170511_111922_create_checkout_result_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('checkout_result', [
            'id' => $this->primaryKey(),
            'checkout_id' => $this->integer()->notNull(),
            'student_id' => $this->integer()->notNull(),
            'score' => $this->decimal(6,2),
            'user_id' => $this->integer()->notNull(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);

        // creates index for column `checkout_id`
        $this->createIndex(
            'idx-checkout_result-checkout_id',
            'checkout_result',
            'checkout_id'
        );

        // add foreign key for table `checkout`
        $this->addForeignKey(
            'fk-checkout_result-checkout_id',
            'checkout_result',
            'checkout_id',
            'checkout',
            'id',
            'CASCADE'
        );

        // creates index for column `student_id`
        $this->createIndex(
            'idx-checkout_result-student_id',
            'checkout_result',
            'student_id'
        );

        // add foreign key for table `student`
        $this->addForeignKey(
            'fk-checkout_result-student_id',
            'checkout_result',
            'student_id',
            'student',
            'id',
            'CASCADE'
        );

        // creates index for column `user_id`
        $this->createIndex(
            'idx-checkout_result-user_id',
            'checkout_result',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-checkout_result-user_id',
            'checkout_result',
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
        // drops foreign key for table `checkout`
        $this->dropForeignKey(
            'fk-checkout_result-checkout_id',
            'checkout_result'
        );

        // drops index for column `checkout_id`
        $this->dropIndex(
            'idx-checkout_result-checkout_id',
            'checkout_result'
        );

        // drops foreign key for table `student`
        $this->dropForeignKey(
            'fk-checkout_result-student_id',
            'checkout_result'
        );

        // drops index for column `student_id`
        $this->dropIndex(
            'idx-checkout_result-student_id',
            'checkout_result'
        );

        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-checkout_result-user_id',
            'checkout_result'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-checkout_result-user_id',
            'checkout_result'
        );

        $this->dropTable('checkout_result');
    }
}
