<?php

use yii\db\Migration;

class m170516_122543_change_checkout_table extends Migration
{
    public function up()
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

        // drops foreign key for table `group`
        $this->dropForeignKey(
            'fk-checkout-group_id',
            'checkout'
        );

        // drops index for column `group_id`
        $this->dropIndex(
            'idx-checkout-group_id',
            'checkout'
        );


        $this->dropColumn('checkout', 'rating_id');
        $this->dropColumn('checkout', 'group_id');
        $this->dropColumn('checkout', 'subject_id');
        $this->dropColumn('checkout', 'year_attestation_id');

    }

    public function down()
    {
        echo "m170516_122543_change_checkout_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
