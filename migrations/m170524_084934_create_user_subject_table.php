<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user_subject`.
 * Has foreign keys to the tables:
 *
 * - `user`
 * - `subject`
 */
class m170524_084934_create_user_subject_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('user_subject', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'subject_id' => $this->integer()->notNull(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            'idx-user_subject-user_id',
            'user_subject',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-user_subject-user_id',
            'user_subject',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

        // creates index for column `subject_id`
        $this->createIndex(
            'idx-user_subject-subject_id',
            'user_subject',
            'subject_id'
        );

        // add foreign key for table `subject`
        $this->addForeignKey(
            'fk-user_subject-subject_id',
            'user_subject',
            'subject_id',
            'subject',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-user_subject-user_id',
            'user_subject'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-user_subject-user_id',
            'user_subject'
        );

        // drops foreign key for table `subject`
        $this->dropForeignKey(
            'fk-user_subject-subject_id',
            'user_subject'
        );

        // drops index for column `subject_id`
        $this->dropIndex(
            'idx-user_subject-subject_id',
            'user_subject'
        );

        $this->dropTable('user_subject');
    }
}
