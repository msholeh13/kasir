<?php

namespace Database\Seeders;

use App\Models\Barang;
use Carbon\Carbon;
use Illuminate\Container\Attributes\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $companyId = '666666';

        $lastRecord = Barang::orderBy('nobarcode', 'desc')->value('nobarcode');

        $lastNumber = $lastRecord ? (int) substr($lastRecord, 6) : 0;

        // jumlah barang baru
        $newProductCount = 50;

        $productData = [];

        $faker = \Faker\Factory::create();

        for ($i = 1; $i <= $newProductCount; $i++) {
            $newNumber = $lastNumber + $i;
            $newCode = $companyId . str_pad($newNumber, 6, '0', STR_PAD_LEFT);

            $productData[] = [
                'nobarcode'     => $newCode,
                'nama'          => $faker->userName(),
                'harga'         => mt_rand(10000, 100000),
                'stok'          => mt_rand(0, 1000),
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ];
        }

        Barang::insert($productData);
    }
}
