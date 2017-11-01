<?php


use Phinx\Migration\AbstractMigration;

class CreateUsersAuth extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        if(!$this->hasTable('accounts')){
            $table = $this->table('accounts', ['signed' => false]);
            $table->addColumn('username', 'string', ['limit' => 50])
                  ->addColumn('hashed', 'string', ['limit' => 255])
                  ->addColumn('created', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
                  ->addIndex(['username', 'hashed'], ['unique' => true])
                  ->create();
       }
    }
   
}
