<?php

use yii\db\Migration;

/**
 * Handles the creation of table `chekout_form`.
 */
class m170504_143057_create_checkout_form_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('checkout_form', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'order_field' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);

        $this->insert('checkout_form', [
            'name' => 'Контрольная работа',
            'order_field' => 1,
            'created_at' => strtotime("now"),
            'updated_at' => strtotime("now"),
        ]);
        $this->insert('checkout_form', [
            'name' => 'Лабораторная работа',
            'order_field' => 2,
            'created_at' => strtotime("now"),
            'updated_at' => strtotime("now"),
        ]);
        $this->insert('checkout_form', [
            'name' => 'Реферат',
            'order_field' => 3,
            'created_at' => strtotime("now"),
            'updated_at' => strtotime("now"),
        ]);
        $this->insert('checkout_form', [
            'name' => 'РГР',
            'order_field' => 4,
            'created_at' => strtotime("now"),
            'updated_at' => strtotime("now"),
        ]);
        $this->insert('checkout_form', [
            'name' => 'Курсовая работа',
            'order_field' => 5,
            'created_at' => strtotime("now"),
            'updated_at' => strtotime("now"),
        ]);
        $this->insert('checkout_form', [
            'name' => 'Курсовой проект',
            'order_field' => 6,
            'created_at' => strtotime("now"),
            'updated_at' => strtotime("now"),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('chekout_form');
    }
}
