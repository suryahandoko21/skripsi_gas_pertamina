<?php

defined('BASEPATH') OR exit('No direct script access allowed');
use Carbon\Carbon;
use Faker\Factory as Faker;
class Migration_create_pangkalan_table extends CI_Migration
{
    public function up()
    {
        try {
            $this->dbforge->drop_table('pangkalan',TRUE);
            $this->dbforge->add_field(array(
                'id' => array(
                        'type' => 'INT',
                        'constraint' => 100,
                        'unsigned' => TRUE,
                        'auto_increment' => TRUE
                ),
                'no_reg' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '100',
                ),
                'company' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '100',
                ),
                'address' => array(
                        'type' => 'VARCHAR',
                        'constraint' => '100',
                ),
                'phone' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '100',
                ),
                'ket' => array(
                        'type' => 'TEXT',
                        'null' => TRUE,
                ),
                'wilayah' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '100',
                    'null' => TRUE,
                ),
            ));
            $this->dbforge->add_key('id', TRUE);
            $this->dbforge->create_table('pangkalan');
        
            // create data dummy
        for ($i=0; $i < 10; $i++) { 
            $this->generateData($i);
        }

        } catch (\Throwable $th) {
            echo 'Message: ' .$th->getMessage();
        }
    }

    public function down()
    {
        $this->dbforge->drop_table('pangkalan',TRUE);
    }
    protected function generateData($i)
    {
        $tgl = Carbon::now();
        try {
            $faker = Faker::create('id_ID');
            $faker->addProvider(new \Faker\Provider\Payment($faker));
            $company =  $faker->company;
            $no_reg = $faker->swiftBicNumber;
            $address = 'Jl.'.$faker->streetName.', '.$faker->address;
            $phone = $faker->e164PhoneNumber;
            $ket = $faker->sentence($nbWords = 10, $variableNbWords = true);
            $wilayah = $faker->randomElement(array ('C1','B1','A1'));
            $dd = compact('company','address','phone','ket','wilayah','no_reg');
            $this->db->insert('pangkalan', $dd);
        } catch (\Throwable $th) {
            dump($th);
        }
    }
}