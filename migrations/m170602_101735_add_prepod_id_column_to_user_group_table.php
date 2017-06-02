<?php

use yii\db\Migration;

/**
 * Handles adding prepod_id to table `user_group`.
 * Has foreign keys to the tables:
 *
 * - `prepod`
 */
class m170602_101735_add_prepod_id_column_to_user_group_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('user_group', 'prepod_id', $this->integer()->notNull());

        // creates index for column `prepod_id`
        $this->createIndex(
            'idx-user_group-prepod_id',
            'user_group',
            'prepod_id'
        );

        // add foreign key for table `prepod`
        $this->addForeignKey(
            'fk-user_group-prepod_id',
            'user_group',
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
            'fk-user_group-prepod_id',
            'user_group'
        );

        // drops index for column `prepod_id`
        $this->dropIndex(
            'idx-user_group-prepod_id',
            'user_group'
        );

        $this->dropColumn('user_group', 'prepod_id');
    }
}
