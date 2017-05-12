<?php

use yii\db\Migration;

/**
 * Handles the creation of table `checkout_work_competence`.
 * Has foreign keys to the tables:
 *
 * - `checkout_work`
 * - `checkout_competence`
 * - `user`
 */
class m170512_104739_create_checkout_work_competence_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('checkout_work_competence', [
            'id' => $this->primaryKey(),
            'checkout_work_id' => $this->integer()->notNull(),
            'checkout_competence_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);

        // creates index for column `checkout_work_id`
        $this->createIndex(
            'idx-checkout_work_competence-checkout_work_id',
            'checkout_work_competence',
            'checkout_work_id'
        );

        // add foreign key for table `checkout_work`
        $this->addForeignKey(
            'fk-checkout_work_competence-checkout_work_id',
            'checkout_work_competence',
            'checkout_work_id',
            'checkout_work',
            'id',
            'CASCADE'
        );

        // creates index for column `checkout_competence_id`
        $this->createIndex(
            'idx-checkout_work_competence-checkout_competence_id',
            'checkout_work_competence',
            'checkout_competence_id'
        );

        // add foreign key for table `checkout_competence`
        $this->addForeignKey(
            'fk-checkout_work_competence-checkout_competence_id',
            'checkout_work_competence',
            'checkout_competence_id',
            'checkout_competence',
            'id',
            'CASCADE'
        );

        // creates index for column `user_id`
        $this->createIndex(
            'idx-checkout_work_competence-user_id',
            'checkout_work_competence',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-checkout_work_competence-user_id',
            'checkout_work_competence',
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
        // drops foreign key for table `checkout_work`
        $this->dropForeignKey(
            'fk-checkout_work_competence-checkout_work_id',
            'checkout_work_competence'
        );

        // drops index for column `checkout_work_id`
        $this->dropIndex(
            'idx-checkout_work_competence-checkout_work_id',
            'checkout_work_competence'
        );

        // drops foreign key for table `checkout_competence`
        $this->dropForeignKey(
            'fk-checkout_work_competence-checkout_competence_id',
            'checkout_work_competence'
        );

        // drops index for column `checkout_competence_id`
        $this->dropIndex(
            'idx-checkout_work_competence-checkout_competence_id',
            'checkout_work_competence'
        );

        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-checkout_work_competence-user_id',
            'checkout_work_competence'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-checkout_work_competence-user_id',
            'checkout_work_competence'
        );

        $this->dropTable('checkout_work_competence');
    }
}
