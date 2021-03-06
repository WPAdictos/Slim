<?php


use Phinx\Migration\AbstractMigration;

class CrearAutoresBio extends AbstractMigration
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
        // create the table
       if(!$this->hasTable('autores_bio')){
            $table = $this->table('autores_bio', ['signed' => false]);
            $table->addColumn('autores_id', 'integer')
                    ->addColumn('bio', 'string', ['limit' => 200])
                    ->addColumn('created', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
                    ->create();
       }
    }
    

}
