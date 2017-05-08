<?php

use yii\db\Migration;

/**
 * Handles adding is_admin to table `user`.
 */
class m170508_085114_add_is_admin_column_to_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('user', 'is_admin', $this->integer()->defaultValue(0));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('user', 'is_admin');
    }
}
