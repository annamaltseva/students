<?php

use yii\db\Migration;

/**
 * Handles dropping rating from table `visit`.
 */
class m170523_131733_drop_rating_column_from_visit_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->dropColumn('visit', 'rating');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->addColumn('visit', 'rating', $this->decimal(6,2)->notNull());
    }
}
