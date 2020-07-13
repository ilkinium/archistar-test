<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Rap2hpoutre\FastExcel\FastExcel;

class DatabaseSeeder extends Seeder
{
    public const TEST_DATA_FILE_PATH = 'test/BackEndTest_TestData_v1.1.xlsx';
    /**
     * @var FastExcel
     */
    private $fastExcel;
    /**
     * @var PropertySeeder
     */
    private $propertySeeder;
    /**
     * @var AnalyticTypeSeeder
     */
    private $analyticTypeSeeder;

    public function __construct(FastExcel $fastExcel, PropertySeeder $propertySeeder, AnalyticTypeSeeder $analyticTypeSeeder)
    {
        $this->fastExcel = $fastExcel;
        $this->propertySeeder = $propertySeeder;
        $this->analyticTypeSeeder = $analyticTypeSeeder;
    }

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

//        die(public_path(self::TEST_DATA_FILE_PATH));
        if (!is_file(public_path(self::TEST_DATA_FILE_PATH))){
            throw new Exception('file not found');
        }
        $this->propertySeeder->run(public_path(self::TEST_DATA_FILE_PATH), $this->fastExcel);
        // $this->call(UserSeeder::class);
    }
}
