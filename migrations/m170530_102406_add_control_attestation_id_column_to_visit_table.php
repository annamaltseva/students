<?php

use yii\db\Migration;

/**
 * Handles adding control_attestation_id to table `visit`.
 * Has foreign keys to the tables:
 *
 * - `control_attestation`
 */
class m170530_102406_add_control_attestation_id_column_to_visit_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('visit', 'control_attestation_id', $this->integer()->notNull());

        // creates index for column `control_attestation_id`
        $this->createIndex(
            'idx-visit-control_attestation_id',
            'visit',
            'control_attestation_id'
        );

        // add foreign key for table `control_attestation`
        $this->addForeignKey(
            'fk-visit-control_attestation_id',
            'visit',
            'control_attestation_id',
            'control_attestation',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `control_attestation`
        $this->dropForeignKey(
            'fk-visit-control_attestation_id',
            'visit'
        );

        // drops index for column `control_attestation_id`
        $this->dropIndex(
            'idx-visit-control_attestation_id',
            'visit'
        );

        $this->dropColumn('visit', 'control_attestation_id');
    }
}
