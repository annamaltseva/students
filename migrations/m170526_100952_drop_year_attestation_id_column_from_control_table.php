<?php

use yii\db\Migration;

/**
 * Handles dropping year_attestation_id from table `control`.
 */
class m170526_100952_drop_year_attestation_id_column_from_control_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        // drops foreign key for table `year_attestation`
        $this->dropForeignKey(
            'fk-control-year_attestation_id',
            'control'
        );

        // drops index for column `year_attestation_id`
        $this->dropIndex(
            'idx-control-year_attestation_id',
            'control'
        );

        $this->dropColumn('control', 'year_attestation_id');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
    }
}
