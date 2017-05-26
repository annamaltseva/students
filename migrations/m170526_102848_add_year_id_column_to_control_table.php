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
        $this->addColumn('control', 'group_id', $this->integer()->notNull());
        $this->addColumn('control', 'subject_id', $this->integer()->notNull());

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

        // creates index for column `group_id`
        $this->createIndex(
            'idx-control-group_id',
            'control',
            'group_id'
        );

        // add foreign key for table `group`
        $this->addForeignKey(
            'fk-control-group_id',
            'control',
            'group_id',
            'group',
            'id',
            'CASCADE'
        );

        // creates index for column `subject_id`
        $this->createIndex(
            'idx-control-subject_id',
            'control',
            'subject_id'
        );

        // add foreign key for table `subject`
        $this->addForeignKey(
            'fk-control-subject_id',
            'control',
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

        // drops foreign key for table `group`
        $this->dropForeignKey(
            'fk-control-group_id',
            'control'
        );

        // drops index for column `group_id`
        $this->dropIndex(
            'idx-control-group_id',
            'control'
        );

        // drops foreign key for table `subject`
        $this->dropForeignKey(
            'fk-control-subject_id',
            'control'
        );

        // drops index for column `subject_id`
        $this->dropIndex(
            'idx-control-subject_id',
            'control'
        );

        $this->dropColumn('control', 'year_id');
        $this->dropColumn('control', 'group_id');
        $this->dropColumn('control', 'subject_id');
    }
}
