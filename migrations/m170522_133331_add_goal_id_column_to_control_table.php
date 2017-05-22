<?php

use yii\db\Migration;

/**
 * Handles adding range_id to table `control`.
 * Has foreign keys to the tables:
 *
 * - `range`
 */
class m170522_133331_add_goal_id_column_to_control_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('control', 'goal_id', $this->integer()->notNull());
        $this->update('control', ['goal_id' =>1]);

        // creates index for column `range_id`
        $this->createIndex(
            'idx-control-goal_id',
            'control',
            'goal_id'
        );

        // add foreign key for table `range`
        $this->addForeignKey(
            'fk-control-goal_id',
            'control',
            'goal_id',
            'goal',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `range`
        $this->dropForeignKey(
            'fk-control-goal_id',
            'control'
        );

        // drops index for column `range_id`
        $this->dropIndex(
            'idx-control-goal_id',
            'control'
        );

        $this->dropColumn('control', 'goal_id');
    }
}
