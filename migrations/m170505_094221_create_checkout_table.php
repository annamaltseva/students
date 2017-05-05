<?php

use yii\db\Migration;

/**
 * Handles the creation of table `checkout`.
 * Has foreign keys to the tables:
 *
 * - `year_attestation`
 * - `subject`
 * - `checkout_form`
 * - `rating`
 * - `user`
 */
class m170505_094221_create_checkout_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('checkout', [
            'id' => $this->primaryKey(),
            'year_attestation_id' => $this->integer()->notNull(),
            'subject_id' => $this->integer()->notNull(),
            'checkout_form_id' => $this->integer()->notNull(),
            'quantity' => $this->integer()->notNull(),
            'rating_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);

        // creates index for column `year_attestation_id`
        $this->createIndex(
            'idx-checkout-year_attestation_id',
            'checkout',
            'year_attestation_id'
        );

        // add foreign key for table `year_attestation`
        $this->addForeignKey(
            'fk-checkout-year_attestation_id',
            'checkout',
            'year_attestation_id',
            'year_attestation',
            'id',
            'CASCADE'
        );

        // creates index for column `subject_id`
        $this->createIndex(
            'idx-checkout-subject_id',
            'checkout',
            'subject_id'
        );

        // add foreign key for table `subject`
        $this->addForeignKey(
            'fk-checkout-subject_id',
            'checkout',
            'subject_id',
            'subject',
            'id',
            'CASCADE'
        );

        // creates index for column `checkout_form_id`
        $this->createIndex(
            'idx-checkout-checkout_form_id',
            'checkout',
            'checkout_form_id'
        );

        // add foreign key for table `checkout_form`
        $this->addForeignKey(
            'fk-checkout-checkout_form_id',
            'checkout',
            'checkout_form_id',
            'checkout_form',
            'id',
            'CASCADE'
        );

        // creates index for column `rating_id`
        $this->createIndex(
            'idx-checkout-rating_id',
            'checkout',
            'rating_id'
        );

        // add foreign key for table `rating`
        $this->addForeignKey(
            'fk-checkout-rating_id',
            'checkout',
            'rating_id',
            'rating',
            'id',
            'CASCADE'
        );

        // creates index for column `user_id`
        $this->createIndex(
            'idx-checkout-user_id',
            'checkout',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-checkout-user_id',
            'checkout',
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
            'fk-checkout-year_attestation_id',
            'checkout'
        );

        // drops index for column `year_attestation_id`
        $this->dropIndex(
            'idx-checkout-year_attestation_id',
            'checkout'
        );

        // drops foreign key for table `subject`
        $this->dropForeignKey(
            'fk-checkout-subject_id',
            'checkout'
        );

        // drops index for column `subject_id`
        $this->dropIndex(
            'idx-checkout-subject_id',
            'checkout'
        );

        // drops foreign key for table `checkout_form`
        $this->dropForeignKey(
            'fk-checkout-checkout_form_id',
            'checkout'
        );

        // drops index for column `checkout_form_id`
        $this->dropIndex(
            'idx-checkout-checkout_form_id',
            'checkout'
        );

        // drops foreign key for table `rating`
        $this->dropForeignKey(
            'fk-checkout-rating_id',
            'checkout'
        );

        // drops index for column `rating_id`
        $this->dropIndex(
            'idx-checkout-rating_id',
            'checkout'
        );

        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-checkout-user_id',
            'checkout'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-checkout-user_id',
            'checkout'
        );

        $this->dropTable('checkout');
    }
}
