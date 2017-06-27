<?php

use Phinx\Seed\AbstractSeed;

class Seed3 extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
    {
        $data = array(
            array(
                'name'  => 'enable_guests',
                'value' => 0,
            )
        );

        $variables = $this->table('variables');
        $variables->insert($data)
                  ->save();
    }
}
