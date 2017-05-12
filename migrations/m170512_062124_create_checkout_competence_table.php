<?php

use yii\db\Migration;

/**
 * Handles the creation of table `checkout_competence`.
 * Has foreign keys to the tables:
 *
 * - `checkout`
 * - `user`
 */
class m170512_062124_create_checkout_competence_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('checkout_competence', [
            'id' => $this->primaryKey(),
            'checkout_id' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);

        // creates index for column `checkout_id`
        $this->createIndex(
            'idx-checkout_competence-checkout_id',
            'checkout_competence',
            'checkout_id'
        );

        // add foreign key for table `checkout`
        $this->addForeignKey(
            'fk-checkout_competence-checkout_id',
            'checkout_competence',
            'checkout_id',
            'checkout',
            'id',
            'CASCADE'
        );

        // creates index for column `user_id`
        $this->createIndex(
            'idx-checkout_competence-user_id',
            'checkout_competence',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-checkout_competence-user_id',
            'checkout_competence',
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
            'fk-checkout_competence-checkout_id',
            'checkout_competence'
        );

        // drops index for column `checkout_id`
        $this->dropIndex(
            'idx-checkout_competence-checkout_id',
            'checkout_competence'
        );

        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-checkout_competence-user_id',
            'checkout_competence'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-checkout_competence-user_id',
            'checkout_competence'
        );

        $this->dropTable('checkout_competence');
    }
}
