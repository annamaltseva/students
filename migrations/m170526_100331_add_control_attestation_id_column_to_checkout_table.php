<?php

use yii\db\Migration;

/**
 * Handles adding control_attestation_id to table `checkout`.
 * Has foreign keys to the tables:
 *
 * - `control_attestation`
 */
class m170526_100331_add_control_attestation_id_column_to_checkout_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('checkout', 'control_attestation_id', $this->integer()->notNull());

        // creates index for column `control_attestation_id`
        $this->createIndex(
            'idx-checkout-control_attestation_id',
            'checkout',
            'control_attestation_id'
        );

        // add foreign key for table `control_attestation`
        $this->addForeignKey(
            'fk-checkout-control_attestation_id',
            'checkout',
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
            'fk-checkout-control_attestation_id',
            'checkout'
        );

        // drops index for column `control_attestation_id`
        $this->dropIndex(
            'idx-checkout-control_attestation_id',
            'checkout'
        );

        $this->dropColumn('checkout', 'control_attestation_id');
    }
}
