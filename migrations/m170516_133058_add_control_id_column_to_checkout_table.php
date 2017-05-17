<?php

use yii\db\Migration;

/**
 * Handles adding control_id to table `checkout`.
 * Has foreign keys to the tables:
 *
 * - `control`
 */
class m170516_133058_add_control_id_column_to_checkout_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('checkout', 'control_id', $this->integer()->notNull());

        // creates index for column `control_id`
        $this->createIndex(
            'idx-checkout-control_id',
            'checkout',
            'control_id'
        );

        // add foreign key for table `control`
        $this->addForeignKey(
            'fk-checkout-control_id',
            'checkout',
            'control_id',
            'control',
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
            'fk-checkout-control_id',
            'checkout'
        );

        // drops index for column `control_id`
        $this->dropIndex(
            'idx-checkout-control_id',
            'checkout'
        );

        $this->dropColumn('checkout', 'control_id');
    }
}
