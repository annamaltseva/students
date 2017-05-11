<?php

use yii\db\Migration;

/**
 * Handles adding group_id to table `checkout`.
 * Has foreign keys to the tables:
 *
 * - `group`
 */
class m170511_105800_add_group_id_column_to_checkout_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('checkout', 'group_id', $this->integer()->notNull());

        // creates index for column `group_id`
        $this->createIndex(
            'idx-checkout-group_id',
            'checkout',
            'group_id'
        );

        // add foreign key for table `group`
        $this->addForeignKey(
            'fk-checkout-group_id',
            'checkout',
            'group_id',
            'group',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
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

        $this->dropColumn('checkout', 'group_id');
    }
}
