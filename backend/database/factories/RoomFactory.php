<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Room;
use Faker\Generator as Faker;

$factory->define(Room::class, function (Faker $faker) {

    return [
        'hotel_id' => App\Hotel::all()->random()->id,
        'type' => function(){

            $types_rooms = [
                'Single',
                'Double',
                'Triple',
                'Quad',
                'Queen',
                'King',
                'Twin'
            ];

            return $types_rooms[random_int(0,sizeof($types_rooms) -1 )];
            
        },
        'available' => random_int(0,10),

    ];
});
