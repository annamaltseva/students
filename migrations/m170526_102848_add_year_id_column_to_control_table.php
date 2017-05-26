<?php

use yii\db\Migration;

/**
 * Handles adding year_id to table `control`.
 * Has foreign keys to the tables:
 *
 * - `year`
 * - `group`
 * - `subject`
 */
class m170526_102848_add_year_id_column_to_control_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('control', 'year_id', $this->integer()->notNull());

        // creates index for column `year_id`
        $this->createIndex(
            'idx-control-year_id',
            'control',
            'year_id'
        );

        // add foreign key for table `year`
        $this->addForeignKey(
            'fk-control-year_id',
            'control',
            'year_id',
            'year',
            'id',
            'CASCADE'
        );

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `year`
        $this->dropForeignKey(
            'fk-control-year_id',
            'control'
        );

        // drops index for column `year_id`
        $this->dropIndex(
            'idx-control-year_id',
            'control'
        );

        $this->dropColumn('control', 'year_id');
    }
}
