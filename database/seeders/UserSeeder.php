<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'ahmed abdelmonem' , 
            'email' => 'ahmed@a.com' , 
            'password' => Hash::make('password') , 
            'phone_number' => '01141157133' , 
        ]);
    }
}
