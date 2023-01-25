<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Series;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
 public function index()
 {
  $series  = Series::take(4)->get();
  $courses = Course::take(6)->get();
  return \view('welcome', [
   'series'  => $series,
   'courses' => $courses,
  ]);
 }

 public function dashboard()
 {
  if (Auth::user()->type === 1) {
   return \view('dashboard');
  } else {
   return \redirect(\route('home'));
  }
 }

//  archive
 public function archive($archive_type, $slug)
 {
  $allowed_archive_types = ['series', 'duration', 'level', 'platform', 'topic'];
  if (!in_array($archive_type, $allowed_archive_types)) {
   return \abort(404);
  }

// duration check
  if ($archive_type === 'duration') {
   $allowed_duration = ['1-5-hours', '5-10-hours', '10-plus-hours'];
   if (!in_array($slug, $allowed_duration)) {
    return \abort(404);
   }
  }
// level check
  if ($archive_type === 'level') {
   $allowed_level = ['beginner', 'intermediate', 'advanced'];
   if (!in_array($slug, $allowed_level)) {
    return \abort(404);
    return \abort(404);
   }
  }
// Platform check
  if ($archive_type === 'platform') {
   $allowed_platform = ['laracasts', 'laravel-daily', 'codecourse', 'laravel-news', 'laracast-forum'];
   if (!in_array($slug, $allowed_platform)) {
    return \abort(404);
   }
  }
// topic check
  if ($archive_type === 'topic') {
   $allowed_topic = ['eloquent', 'validation', 'authentication', 'refactoring', 'testing'];
   if (!in_array($slug, $allowed_topic)) {
    return \abort(404);
   }
  }

//   Title of the Archive
  if ($archive_type === 'series') {
   $item = Series::where('slug', $slug)->first();

   if (empty($item)) {return \abort(404);}
   $title   = 'Courses on ' . $item->name;
   $courses = $item->courses()->paginate(12);
  } elseif ($archive_type === 'duration') {
   if ($slug == '1-5-hours') {
    $item            = '1-5 hours';
    $duration_db_key = 0;
   } elseif ($slug == '5-10-hours') {
    $item            = '5-10 hours';
    $duration_db_key = 1;
   } else {
    $item            = '10+ hours';
    $duration_db_key = 2;
   }
   $title   = 'Courses with Duration ' . $item;
   $courses = Course::where('duration', $duration_db_key)->paginate(12);
  }

  return \view('archive.single', [
   'title'   => $title,
   'courses' => $courses,
  ]);
 }
}