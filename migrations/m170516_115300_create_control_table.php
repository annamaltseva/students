<?php

use yii\db\Migration;

/**
 * Handles the creation of table `control`.
 * Has foreign keys to the tables:
 *
 * - `year_attestation`
 * - `group`
 * - `subject`
 * - `rating`
 * - `user`
 */
class m170516_115300_create_control_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('control', [
            'id' => $this->primaryKey(),
            'year_attestation_id' => $this->integer()->notNull(),
            'group_id' => $this->integer()->notNull(),
            'subject_id' => $this->integer()->notNull(),
            'rating_id' => $this->integer()->notNull(),
            'limit_rating' => $this->decimal(6,2)->notNull(),
            'user_id' => $this->integer()->notNull(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);

        // creates index for column `year_attestation_id`
        $this->createIndex(
            'idx-control-year_attestation_id',
            'control',
            'year_attestation_id'
        );

        // add foreign key for table `year_attestation`
        $this->addForeignKey(
            'fk-control-year_attestation_id',
            'control',
            'year_attestation_id',
            'year_attestation',
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

        // creates index for column `rating_id`
        $this->createIndex(
            'idx-control-rating_id',
            'control',
            'rating_id'
        );

        // add foreign key for table `rating`
        $this->addForeignKey(
            'fk-control-rating_id',
            'control',
            'rating_id',
            'rating',
            'id',
            'CASCADE'
        );

        // creates index for column `user_id`
        $this->createIndex(
            'idx-control-user_id',
            'control',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-control-user_id',
            'control',
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

        // drops foreign key for table `rating`
        $this->dropForeignKey(
            'fk-control-rating_id',
            'control'
        );

        // drops index for column `rating_id`
        $this->dropIndex(
            'idx-control-rating_id',
            'control'
        );

        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-control-user_id',
            'control'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-control-user_id',
            'control'
        );

        $this->dropTable('control');
    }
}
