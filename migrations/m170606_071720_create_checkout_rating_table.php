<?php

use yii\db\Migration;

/**
 * Handles the creation of table `checkout_rating`.
 * Has foreign keys to the tables:
 *
 * - `checkout`
 * - `user`
 */
class m170606_071720_create_checkout_rating_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('checkout_rating', [
            'id' => $this->primaryKey(),
            'checkout_id' => $this->integer()->notNull(),
            'work_num' => $this->integer()->notNull(),
            'score' => $this->decimal(6,2)->notNull(),
            'user_id' => $this->integer()->notNull(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);

        // creates index for column `checkout_id`
        $this->createIndex(
            'idx-checkout_rating-checkout_id',
            'checkout_rating',
            'checkout_id'
        );

        // add foreign key for table `checkout`
        $this->addForeignKey(
            'fk-checkout_rating-checkout_id',
            'checkout_rating',
            'checkout_id',
            'checkout',
            'id',
            'CASCADE'
        );

        // creates index for column `user_id`
        $this->createIndex(
            'idx-checkout_rating-user_id',
            'checkout_rating',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-checkout_rating-user_id',
            'checkout_rating',
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
            'fk-checkout_rating-checkout_id',
            'checkout_rating'
        );

        // drops index for column `checkout_id`
        $this->dropIndex(
            'idx-checkout_rating-checkout_id',
            'checkout_rating'
        );

        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-checkout_rating-user_id',
            'checkout_rating'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-checkout_rating-user_id',
            'checkout_rating'
        );

        $this->dropTable('checkout_rating');
    }
}
