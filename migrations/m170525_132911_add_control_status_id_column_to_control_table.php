<?php

use yii\db\Migration;

/**
 * Handles adding control_status_id to table `control`.
 * Has foreign keys to the tables:
 *
 * - `control_status`
 */
class m170525_132911_add_control_status_id_column_to_control_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('control', 'control_status_id', $this->integer().' DEFAULT 1');

        // creates index for column `control_status_id`
        $this->createIndex(
            'idx-control-control_status_id',
            'control',
            'control_status_id'
        );

        // add foreign key for table `control_status`
        $this->addForeignKey(
            'fk-control-control_status_id',
            'control',
            'control_status_id',
            'control_status',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `control_status`
        $this->dropForeignKey(
            'fk-control-control_status_id',
            'control'
        );

        // drops index for column `control_status_id`
        $this->dropIndex(
            'idx-control-control_status_id',
            'control'
        );

        $this->dropColumn('control', 'control_status_id');
    }
}
