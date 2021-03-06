<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Rap2hpoutre\FastExcel\FastExcel;

class AnalyticTypeSeeder extends Seeder
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
            ($fastExcel)->sheet(2)->import(
                $fileName,
                function ($line) {
                    return DB::table('analytic_types')->insert(
                        [
                            'name' => $line['name'],
                            'units' => $line['units'],
                            'is_numeric' => $line['is_numeric'],
                            'num_decimal_places' => $line['num_decimal_places']
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
