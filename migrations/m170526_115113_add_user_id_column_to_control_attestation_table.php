<?php

use yii\db\Migration;

/**
 * Handles adding user_id to table `control_attestation`.
 * Has foreign keys to the tables:
 *
 * - `user`
 */
class m170526_115113_add_user_id_column_to_control_attestation_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('control_attestation', 'user_id', $this->integer()->notNull());

        // creates index for column `user_id`
        $this->createIndex(
            'idx-control_attestation-user_id',
            'control_attestation',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-control_attestation-user_id',
            'control_attestation',
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
        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-control_attestation-user_id',
            'control_attestation'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-control_attestation-user_id',
            'control_attestation'
        );

        $this->dropColumn('control_attestation', 'user_id');
    }
}
