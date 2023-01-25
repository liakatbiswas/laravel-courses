<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Author;
use App\Models\Course;
use App\Models\Platform;
use App\Models\Review;
use App\Models\Series;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
 /**
  * Seed the application's database.
  *
  * @return void
  */
 public function run()
 {

  // create admin user
  User::create([
   'name'     => 'Admin',
   'email'    => 'admin@liakat.com',
   'password' => \bcrypt(1234),
   'type'     => 1,
  ]);

//   $series = ['PHP', 'JavaScript', 'WordPress', 'Laravel'];
//   foreach ($series as $item) {
//    Series::create([
//     'name' => $item,
//    ]);
//   }

  $series = [
   [
    'name'  => 'Laravel',
    'slug'  => 'laravel',
    'image' => 'https://i.pcmag.com/imagery/articles/00Cx7vFIetxCuKxQeqPf8mi-23.fit_lim.size_1600x900.v1643131202.jpg',
   ],

   [
    'name'  => 'PHP',
    'slug'  => 'php',
    'image' => 'https://i.pcmag.com/imagery/articles/00Cx7vFIetxCuKxQeqPf8mi-23.fit_lim.size_1600x900.v1643131202.jpg',
   ],
   [
    'name'  => 'Livewire',
    'slug'  => 'livewire',
    'image' => 'https://i.pcmag.com/imagery/articles/00Cx7vFIetxCuKxQeqPf8mi-23.fit_lim.size_1600x900.v1643131202.jpg',
   ],
   [
    'name'  => 'JavaScript',
    'slug'  => 'javascript',
    'image' => 'https://i.pcmag.com/imagery/articles/00Cx7vFIetxCuKxQeqPf8mi-23.fit_lim.size_1600x900.v1643131202.jpg',
   ],
   [
    'name'  => 'jQuery',
    'slug'  => 'jquery',
    'image' => 'https://i.pcmag.com/imagery/articles/00Cx7vFIetxCuKxQeqPf8mi-23.fit_lim.size_1600x900.v1643131202.jpg',
   ],
  ];
  foreach ($series as $item) {
   Series::create([
    'name'  => $item['name'],
    'slug'  => $item['slug'],
    'image' => $item['image'],
   ]);
  }

  $topics = ['Eloquent', 'Validation', 'Authentication', 'Testing', 'Refactoring'];
  foreach ($topics as $item) {
   $slug = \strtolower(\str_replace(' ', '-', $item));

   Topic::create([
    'name' => $item,
    'slug' => $slug,
   ]);
  }

  $flatforms = ['Laracasts', 'Laravel Daily', 'Codecourse', 'Laravel News', 'Laracast Forum'];
  foreach ($flatforms as $item) {
   Platform::create([
    'name' => $item,
   ]);
  }

  /**
   * যেহেতু Author আপডেট করেছি তাই এভাবে তথ্য নিলে হবেনা এবং এর জন্য একটা ফেক্টরি তৈরি করেছি ক্লাস ১১
   * $authors = ['Liakat Biswas', 'Nafi', 'Jahan', 'LaravelFriend', 'Laracast'];
   * foreach ($authors as $item) {
   * Author::create([
   *    'name' => $item,
   *        ]);
   *    }
   * */

  /** To create Author */
  Author::factory(10)->create();
  /** Create 50 Users */
  User::factory(25)->create();
  /** Create 100 Courses */
  Course::factory(100)->create();

  /** Multiple relation */
  $courses = Course::all();
  foreach ($courses as $course) {
   $topics = Topic::all()->random(rand(1, 5))->pluck('id')->toArray();
   $course->topics()->attach($topics);
   $authors = Author::all()->random(rand(1, 5))->pluck('id')->toArray();
   $course->authors()->attach($authors);
   $series = Series::all()->random(rand(1, 5))->pluck('id')->toArray();
   $course->series()->attach($series);
  }

  /** To create review */
  Review::factory(100)->create();

 }
}