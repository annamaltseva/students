<?php

use yii\db\Migration;

/**
 * Handles the creation of table `attestation`.
 */
class m170505_074626_create_attestation_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('attestation', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'order_field' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);
        $this->insert('attestation', [
            'name' => 'Первая промежуточная аттестация',
            'order_field' => 1,
            'created_at' => strtotime("now"),
            'updated_at' => strtotime("now"),
        ]);
        $this->insert('attestation', [
            'name' => 'Вторая промежуточная аттестация',
            'order_field' => 2,
            'created_at' => strtotime("now"),
            'updated_at' => strtotime("now"),
        ]);
        $this->insert('attestation', [
            'name' => 'Зачёт/экзамен',
            'order_field' => 3,
            'created_at' => strtotime("now"),
            'updated_at' => strtotime("now"),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('attestation');
    }
}
