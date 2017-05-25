<?php

use yii\db\Migration;

/**
 * Handles the creation of table `control_status`.
 */
class m170525_132330_create_control_status_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('control_status', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
        ]);

        $this->insert('control_status', [
            'name' => 'Оценивание'
        ]);

        $this->insert('control_status', [
            'name' => 'Оценивание завершено'
        ]);

        $this->insert('control_status', [
            'name' => 'Сформированы результаты'
        ]);

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('control_status');
    }
}
