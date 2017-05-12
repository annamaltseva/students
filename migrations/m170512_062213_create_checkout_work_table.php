<?php

use yii\db\Migration;

/**
 * Handles the creation of table `checkout_work`.
 * Has foreign keys to the tables:
 *
 * - `checkout`
 * - `user`
 */
class m170512_062213_create_checkout_work_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('checkout_work', [
            'id' => $this->primaryKey(),
            'checkout_id' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);

        // creates index for column `checkout_id`
        $this->createIndex(
            'idx-checkout_work-checkout_id',
            'checkout_work',
            'checkout_id'
        );

        // add foreign key for table `checkout`
        $this->addForeignKey(
            'fk-checkout_work-checkout_id',
            'checkout_work',
            'checkout_id',
            'checkout',
            'id',
            'CASCADE'
        );

        // creates index for column `user_id`
        $this->createIndex(
            'idx-checkout_work-user_id',
            'checkout_work',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-checkout_work-user_id',
            'checkout_work',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `checkout`
        $this->dropForeignKey(
            'fk-checkout_work-checkout_id',
            'checkout_work'
        );

        // drops index for column `checkout_id`
        $this->dropIndex(
            'idx-checkout_work-checkout_id',
            'checkout_work'
        );

        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-checkout_work-user_id',
            'checkout_work'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-checkout_work-user_id',
            'checkout_work'
        );

        $this->dropTable('checkout_work');
    }
}
