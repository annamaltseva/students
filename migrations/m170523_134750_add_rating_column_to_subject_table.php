<?php

use yii\db\Migration;

/**
 * Handles adding rating to table `subject`.
 */
class m170523_134750_add_rating_column_to_subject_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('subject', 'rating', $this->decimal(6,2)->notNull());
        $this->update('subject', ['rating' =>1]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('subject', 'rating');
    }
}
