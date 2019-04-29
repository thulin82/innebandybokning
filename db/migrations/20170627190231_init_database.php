<?php

use Phinx\Migration\AbstractMigration;

class InitDatabase extends AbstractMigration
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
        //Create the first table
        $table = $this->table('password');
        $table->addColumn('user', 'string')
              ->addColumn('password_hash', 'string')
              ->create();
              
                //Create the second table
        $table2 = $this->table('stats');
        $table2->addColumn('name', 'string')
               ->addColumn('total_leader', 'integer')
               ->addColumn('season_leader', 'integer')
               ->addColumn('aut2012', 'integer')
               ->addColumn('spring2013', 'integer')
               ->addColumn('aut2013', 'integer')
               ->addColumn('spring2014', 'integer')
               ->addColumn('nbr_seasons', 'integer')
               ->create();
              
        //Create the third table
        $table3 = $this->table('users');
        $table3->addColumn('name', 'string')
               ->addColumn('mail', 'string')
               ->addColumn('attend', 'integer')
               ->addColumn('guests', 'integer')
               ->addColumn('nbr_of_attends', 'integer')
               ->create();
               
        //Create the fourth table
        $table4 = $this->table('variables');
        $table4->addColumn('name', 'string')
               ->addColumn('value', 'integer')
               ->create();
              
        //Create the fifth table
        $table5 = $this->table('weekdata');
        $table5->addColumn('week', 'integer')
               ->addColumn('currentweek', 'integer')
               ->addColumn('date', 'string')
               ->create();
    }
}
