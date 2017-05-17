<?php

use yii\db\Migration;

/**
 * Handles adding work_num to table `checkout_result`.
 */
class m170517_125758_add_work_num_column_to_checkout_result_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('checkout_result', 'work_num', $this->integer()->notNull());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('checkout_result', 'work_num');
    }
}
