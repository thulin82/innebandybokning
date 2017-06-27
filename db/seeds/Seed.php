<?php

use Phinx\Seed\AbstractSeed;

class Seed extends AbstractSeed
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
                'name'           => 'Anders Andersson',
                'mail'           => 'anders.andersson@test.test',
                'attend'         => 2,
                'guests'         => 0,
                'coop'           => 0,
                'nbr_of_attends' => 0,
            ),
            array(
                'name'           => 'Bertil Bengtsson',
                'mail'           => 'bertil.bengtsson@test.test',
                'attend'         => 2,
                'guests'         => 0,
                'coop'           => 0,
                'nbr_of_attends' => 0,
            ),
            array(
                'name'           => 'Conny Connysson',
                'mail'           => 'conny.connysson@test.test',
                'attend'         => 2,
                'guests'         => 0,
                'coop'           => 0,
                'nbr_of_attends' => 0,
            ),
            array(
                'name'           => 'David Danielsson',
                'mail'           => 'david.danielsson@test.test',
                'attend'         => 2,
                'guests'         => 0,
                'coop'           => 0,
                'nbr_of_attends' => 0,
            )
        );

        $users = $this->table('users');
        $users->insert($data)
              ->save();
    }
}
