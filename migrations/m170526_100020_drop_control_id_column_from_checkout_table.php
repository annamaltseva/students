<?php

use yii\db\Migration;

/**
 * Handles dropping control_id from table `checkout`.
 */
class m170526_100020_drop_control_id_column_from_checkout_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
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

    /**
     * @inheritdoc
     */
    public function down()
    {
    }
}
