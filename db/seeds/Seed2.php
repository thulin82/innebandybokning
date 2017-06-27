<?php

use Phinx\Seed\AbstractSeed;

class Seed2 extends AbstractSeed
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
                'week'        => 26,
                'currentweek' => 1,
                'date'        => '26/6',
            ),
            array(
                'week'        => 27,
                'currentweek' => 0,
                'date'        => '3/7',
            ),
            array(
                'week'        => 28,
                'currentweek' => 0,
                'date'        => '10/7',
            ),
            array(
                'week'        => 29,
                'currentweek' => 0,
                'date'        => '17/7',
            )
        );

        $weekdata = $this->table('weekdata');
        $weekdata->insert($data)
                 ->save();
    }
}
