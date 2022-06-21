<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Models\Courts;
use App\Models\User;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'id'        => 69448,
            'role'      => 'Admin',
            'name'      => 'David Bong',
            'faculty'   => 'FCSIT',
            'mobileNum' => '01119896950',
            'email'     => 'davidbong05@gmail.com',
            'password'  => '12345678',
            'email_verified_at' => Carbon::now(),
        ]);

        DB::table('facilities')->insert(
            [
                [
                    'name'          => 'Badminton',
                    'image'         => '/img/facility/court_1_piapqn.jpg',
                    'description'   => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas porttitor congue massa. '

                ],
                [
                    'name'          => 'Squash',
                    'image'         => '/img/facility/court_2_rsnujz.jpg',
                    'description'   => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas porttitor congue massa. '

                ],
                [
                    'name'          => 'Futsal',
                    'image'         => '/img/facility/court_3_yaov2c.jpg',
                    'description'   => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas porttitor congue massa. '

                ],
                [
                    'name'          => 'Tennis',
                    'image'         => '/img/facility/court_4_uqclwm.jpg',
                    'description'   => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas porttitor congue massa. '

                ],
                [
                    'name'          => 'Netball',
                    'image'         => '/img/facility/court_5_lh8qlm.jpg',
                    'description'   => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas porttitor congue massa. '

                ],
                [
                    'name'          => 'Volleyball',
                    'image'         => '/img/facility/court_6_flzju0.jpg',
                    'description'   => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas porttitor congue massa. '

                ],
                [
                    'name'          => 'Basketball',
                    'image'         => '/img/facility/court_7_ua7twy.jpg',
                    'description'   => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas porttitor congue massa. '

                ],
                [
                    'name'          => 'Takraw',
                    'image'         => '/img/facility/court_8_glsoyy.jpg',
                    'description'   => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas porttitor congue massa. '

                ],
                [
                    'name'          => 'Rugby',
                    'image'         => '/img/facility/court_9_hbt8wl.jpg',
                    'description'   => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas porttitor congue massa. '

                ]
            ]
        );

        Courts::create([
            'facilities_id' =>  1,
            'name'          =>  "Badminton 1",
        ]);
        Courts::create([
            'facilities_id' =>  1,
            'name'          =>  "Badminton 2",
        ]);
        Courts::create([
            'facilities_id' =>  1,
            'name'          =>  "Badminton 3",
        ]);
        Courts::create([
            'facilities_id' =>  2,
            'name'          =>  "Squash 1",
        ]);
        Courts::create([
            'facilities_id' =>  2,
            'name'          =>  "Squash 2",
        ]);
        Courts::create([
            'facilities_id' =>  2,
            'name'          =>  "Squash 3",
        ]);
        Courts::create([
            'facilities_id' =>  3,
            'name'          =>  "Futsal A",
        ]);
        Courts::create([
            'facilities_id' =>  3,
            'name'          =>  "Futsal B",
        ]);
    }
};