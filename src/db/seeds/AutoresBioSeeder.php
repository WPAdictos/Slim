<?php


use Phinx\Seed\AbstractSeed;

class AutoresBioSeeder extends AbstractSeed
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
        $faker = Faker\Factory::create('es_ES'); 
        for ($i=1; $i < 3; $i++) {
            $data=array();
            $data['autores_id']=$i;
            $data['bio']=$faker->text($maxNbChars = 198);
            $this->insert('autores_bio', $data);
        }

    }
}
