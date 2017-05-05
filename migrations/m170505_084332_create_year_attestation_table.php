<?php

use yii\db\Migration;

/**
 * Handles the creation of table `year_attestation`.
 * Has foreign keys to the tables:
 *
 * - `year`
 * - `attestation`
 * - `user`
 */
class m170505_084332_create_year_attestation_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('year_attestation', [
            'id' => $this->primaryKey(),
            'year_id' => $this->integer()->notNull(),
            'attestation_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);

        // creates index for column `year_id`
        $this->createIndex(
            'idx-year_attestation-year_id',
            'year_attestation',
            'year_id'
        );

        // add foreign key for table `year`
        $this->addForeignKey(
            'fk-year_attestation-year_id',
            'year_attestation',
            'year_id',
            'year',
            'id',
            'CASCADE'
        );

        // creates index for column `attestation_id`
        $this->createIndex(
            'idx-year_attestation-attestation_id',
            'year_attestation',
            'attestation_id'
        );

        // add foreign key for table `attestation`
        $this->addForeignKey(
            'fk-year_attestation-attestation_id',
            'year_attestation',
            'attestation_id',
            'attestation',
            'id',
            'CASCADE'
        );

        // creates index for column `user_id`
        $this->createIndex(
            'idx-year_attestation-user_id',
            'year_attestation',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-year_attestation-user_id',
            'year_attestation',
            'user_id',
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
        // drops foreign key for table `year`
        $this->dropForeignKey(
            'fk-year_attestation-year_id',
            'year_attestation'
        );

        // drops index for column `year_id`
        $this->dropIndex(
            'idx-year_attestation-year_id',
            'year_attestation'
        );

        // drops foreign key for table `attestation`
        $this->dropForeignKey(
            'fk-year_attestation-attestation_id',
            'year_attestation'
        );

        // drops index for column `attestation_id`
        $this->dropIndex(
            'idx-year_attestation-attestation_id',
            'year_attestation'
        );

        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-year_attestation-user_id',
            'year_attestation'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-year_attestation-user_id',
            'year_attestation'
        );

        $this->dropTable('year_attestation');
    }
}
