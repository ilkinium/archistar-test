<?php

use App\Property;
use Illuminate\Database\Seeder;
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
                storage_path($fileName),
                function ($line) {
                    return Property::create(
                        [
                            'suburb' => $line['Suburb'],
                            'state' => $line['State'],
                            'country' => $line['Country']
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
