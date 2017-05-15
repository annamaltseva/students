<?php

use yii\db\Migration;

/**
 * Handles the creation of table `visit`.
 * Has foreign keys to the tables:
 *
 * - `year_attestation`
 * - `group`
 * - `subject`
 * - `user`
 */
class m170515_094412_create_visit_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('visit', [
            'id' => $this->primaryKey(),
            'date' => $this->date()->notNull(),
            'year_attestation_id' => $this->integer()->notNull(),
            'group_id' => $this->integer()->notNull(),
            'subject_id' => $this->integer()->notNull(),
            'rating' => $this->decimal(6,2)->notNull(),
            'description' => $this->string(),
            'user_id' => $this->integer()->notNull(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);

        // creates index for column `year_attestation_id`
        $this->createIndex(
            'idx-visit-year_attestation_id',
            'visit',
            'year_attestation_id'
        );

        // add foreign key for table `year_attestation`
        $this->addForeignKey(
            'fk-visit-year_attestation_id',
            'visit',
            'year_attestation_id',
            'year_attestation',
            'id',
            'CASCADE'
        );

        // creates index for column `group_id`
        $this->createIndex(
            'idx-visit-group_id',
            'visit',
            'group_id'
        );

        // add foreign key for table `group`
        $this->addForeignKey(
            'fk-visit-group_id',
            'visit',
            'group_id',
            'group',
            'id',
            'CASCADE'
        );

        // creates index for column `subject_id`
        $this->createIndex(
            'idx-visit-subject_id',
            'visit',
            'subject_id'
        );

        // add foreign key for table `subject`
        $this->addForeignKey(
            'fk-visit-subject_id',
            'visit',
            'subject_id',
            'subject',
            'id',
            'CASCADE'
        );

        // creates index for column `user_id`
        $this->createIndex(
            'idx-visit-user_id',
            'visit',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-visit-user_id',
            'visit',
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
            'fk-visit-year_attestation_id',
            'visit'
        );

        // drops index for column `year_attestation_id`
        $this->dropIndex(
            'idx-visit-year_attestation_id',
            'visit'
        );

        // drops foreign key for table `group`
        $this->dropForeignKey(
            'fk-visit-group_id',
            'visit'
        );

        // drops index for column `group_id`
        $this->dropIndex(
            'idx-visit-group_id',
            'visit'
        );

        // drops foreign key for table `subject`
        $this->dropForeignKey(
            'fk-visit-subject_id',
            'visit'
        );

        // drops index for column `subject_id`
        $this->dropIndex(
            'idx-visit-subject_id',
            'visit'
        );

        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-visit-user_id',
            'visit'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-visit-user_id',
            'visit'
        );

        $this->dropTable('visit');
    }
}
