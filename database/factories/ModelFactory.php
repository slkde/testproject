<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/
//
// $factory->define(App\Model\Question::class, function (Faker\Generator $faker) {
// 	$user_ids = \App\Model\User::lists('id')->toArray();
// 	return [

//        'title' => $faker->sentence,
//        'content' => $faker->paragraph,
//        'topic_id' =>$faker-> imageUrl(256,256),
//        'user_id' => $faker->randomElement($user_ids),
//        'photo' => $faker->imageUrl(256,256),
//        'status' =>$faker-> numberBetween(0,1),
//        'bonus' => $faker->numberBetween(0,999),
//        'support' => $faker->numberBetween(0,999),
//        'price' => $faker->numberBetween(0,999),
//    ];
// });

// $factory->define(App\Model\User::class, function (Faker\Generator $faker) {
// 	return [
// 		'username' => $faker->name,
// 		'nickname' => $faker->name,
// 		'email' => $faker->safeEmail,
// 		'photo' => $faker->imageUrl(256,256),
// 		'password' => bcrypt(str_random(10)),

// 	];
// });
// $factory->define(App\Model\Detail::class, function (Faker\Generator $faker) {
// 	$user_ids = \App\Model\User::lists('id')->toArray();
// 	$question_ids = \App\Model\Question::lists('id')->toArray();
// 	return [
		
// 		'answer_content' => $faker->paragraph,
// 		'question_id' =>$faker->randomElement($question_ids),
// 		'user_id' => $faker->randomElement($user_ids),
// 	];
// });
