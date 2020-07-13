<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Rap2hpoutre\FastExcel\FastExcel;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param string $fileName
     * @param FastExcel $fastExcel
     * @return void
     */
    public function run(string $fileName, FastExcel $fastExcel)
    {
        try {
            ($fastExcel)->import(
                $fileName,
                function ($line) {
                    return DB::table('properties')->insert(
                        [
                            'suburb' => $line['Suburb'],
                            'state' => $line['State'],
                            'country' => $line['Counrty']
                        ]
                    );
                }
            );
        } catch (\Box\Spout\Common\Exception\IOException $e) {
        } catch (\Box\Spout\Common\Exception\UnsupportedTypeException $e) {
        } catch (\Box\Spout\Reader\Exception\ReaderNotOpenedException $e) {
        }
    }
}
