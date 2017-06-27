<?php

use Phinx\Seed\AbstractSeed;

class Seed4 extends AbstractSeed
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
                'user'          => 'user',
                'password_hash' => '$2y$10$/b/Rn3FJc6J3qxsQrXWWduFYiT61scAUapyNSqaoTfO595/pA00Fi',
            ),
            array(
                'user'          => 'admin',
                'password_hash' => '$2y$10$7mVpHqYYBji79gEcQLMjBuTb1Ao5yCveLuMAdH5ZwLxJZG6siav3m',
            ),
        );

        $password = $this->table('password');
        $password->insert($data)
                 ->save();
    }
}
