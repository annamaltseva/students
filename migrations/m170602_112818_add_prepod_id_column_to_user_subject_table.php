<?php

use yii\db\Migration;

/**
 * Handles adding prepod_id to table `user_subject`.
 * Has foreign keys to the tables:
 *
 * - `prepod`
 */
class m170602_112818_add_prepod_id_column_to_user_subject_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('user_subject', 'prepod_id', $this->integer()->notNull());

        // creates index for column `prepod_id`
        $this->createIndex(
            'idx-user_subject-prepod_id',
            'user_subject',
            'prepod_id'
        );

        // add foreign key for table `prepod`
        $this->addForeignKey(
            'fk-user_subject-prepod_id',
            'user_subject',
            'prepod_id',
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
        // drops foreign key for table `prepod`
        $this->dropForeignKey(
            'fk-user_subject-prepod_id',
            'user_subject'
        );

        // drops index for column `prepod_id`
        $this->dropIndex(
            'idx-user_subject-prepod_id',
            'user_subject'
        );

        $this->dropColumn('user_subject', 'prepod_id');
    }
}
