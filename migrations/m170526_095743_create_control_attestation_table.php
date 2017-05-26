<?php

use yii\db\Migration;

/**
 * Handles the creation of table `control_attestation`.
 * Has foreign keys to the tables:
 *
 * - `control`
 * - `attestation`
 */
class m170526_095743_create_control_attestation_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('control_attestation', [
            'id' => $this->primaryKey(),
            'control_id' => $this->integer()->notNull(),
            'attestation_id' => $this->integer()->notNull(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);

        // creates index for column `control_id`
        $this->createIndex(
            'idx-control_attestation-control_id',
            'control_attestation',
            'control_id'
        );

        // add foreign key for table `control`
        $this->addForeignKey(
            'fk-control_attestation-control_id',
            'control_attestation',
            'control_id',
            'control',
            'id',
            'CASCADE'
        );

        // creates index for column `attestation_id`
        $this->createIndex(
            'idx-control_attestation-attestation_id',
            'control_attestation',
            'attestation_id'
        );

        // add foreign key for table `attestation`
        $this->addForeignKey(
            'fk-control_attestation-attestation_id',
            'control_attestation',
            'attestation_id',
            'attestation',
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
            'fk-control_attestation-control_id',
            'control_attestation'
        );

        // drops index for column `control_id`
        $this->dropIndex(
            'idx-control_attestation-control_id',
            'control_attestation'
        );

        // drops foreign key for table `attestation`
        $this->dropForeignKey(
            'fk-control_attestation-attestation_id',
            'control_attestation'
        );

        // drops index for column `attestation_id`
        $this->dropIndex(
            'idx-control_attestation-attestation_id',
            'control_attestation'
        );

        $this->dropTable('control_attestation');
    }
}
