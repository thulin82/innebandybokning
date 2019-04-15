<?php

use Phinx\Seed\AbstractSeed;

class Seed5 extends AbstractSeed
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
                'name'          => 'Anders Andersson',
                'total_leader' => '1',
                'season_leader' => '1',
                'aut2012' => '12',
                'spring2013' => '9',
            ),
            array(
                'name'          => 'Bertil Bengtsson',
                'total_leader' => '0',
                'season_leader' => '0',
                'aut2012' => '10',
                'spring2013' => '3',
            ),
        );

        $stats = $this->table('stats');
        $stats->insert($data)
                 ->save();
    }
}
