<?php

use yii\db\Migration;

/**
 * Handles adding control_id to table `visit`.
 * Has foreign keys to the tables:
 *
 * - `control`
 */
class m170517_142557_add_control_id_column_to_visit_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('visit', 'control_id', $this->integer()->notNull());

        // creates index for column `control_id`
        $this->createIndex(
            'idx-visit-control_id',
            'visit',
            'control_id'
        );

        // add foreign key for table `control`
        $this->addForeignKey(
            'fk-visit-control_id',
            'visit',
            'control_id',
            'control',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `control`
        $this->dropForeignKey(
            'fk-visit-control_id',
            'visit'
        );

        // drops index for column `control_id`
        $this->dropIndex(
            'idx-visit-control_id',
            'visit'
        );

        $this->dropColumn('visit', 'control_id');
    }
}
