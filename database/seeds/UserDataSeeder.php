<?php

use Illuminate\Database\Seeder;
use App\UserData;
class UserDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table("user_datas")->truncate();
        $this->getCsvData();
    }

        public function getCsvData(){
            $csv_details = [];
            //the path to where the csv data is stored
            $path = public_path('export.csv');
            if (($handle = fopen($path, "r")) !== FALSE) {
                while (($data = fgetcsv($handle, 5000, ";")) !== FALSE) {
                    $csv_details [] =$data;
                }
                fclose($handle);
            }
            //strip the first row to use it as the header
            $header = array_shift($csv_details);

            //here make the associative array to simulate a db table to use it for searching and sorting

            $csv_details_table =[];
            foreach ($csv_details as $row){
                $csv_details_table[] = array_combine($header, $row);
            }
            foreach ($csv_details_table as $table){
                $user = new UserData();
                $user->fill($table);
                $user->save();
            }
        }
}
