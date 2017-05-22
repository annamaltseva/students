<?php

use yii\db\Migration;

/**
 * Handles dropping limit_rating from table `control`.
 */
class m170522_132609_drop_limit_rating_column_from_control_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->dropColumn('control', 'limit_rating');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->addColumn('control', 'limit_rating', $this->decimal(6,2));
    }
}
