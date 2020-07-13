<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Rap2hpoutre\FastExcel\FastExcel;

class PropertyAnalyticSeeder extends Seeder
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
            ($fastExcel)->sheet(3)->import(
                $fileName,
                function ($line) {
                    return DB::table('property_analytics')->insert(
                        [
                            'property_id' => $line['property_id'],
                            'analytic_type_id' => $line['anaytic_type_id'],
                            'value' => $line['value']
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
