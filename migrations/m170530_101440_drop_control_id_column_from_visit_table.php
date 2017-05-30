<?php

use yii\db\Migration;

/**
 * Handles dropping control_id from table `visit`.
 */
class m170530_101440_drop_control_id_column_from_visit_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
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

    /**
     * @inheritdoc
     */
    public function down()
    {
    }
}
