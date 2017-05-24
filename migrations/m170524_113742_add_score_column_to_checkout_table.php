<?php

use yii\db\Migration;

/**
 * Handles adding rating to table `checkout`.
 */
class m170524_113742_add_score_column_to_checkout_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('checkout', 'score', $this->decimal(6,2));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('checkout', 'score');
    }
}
