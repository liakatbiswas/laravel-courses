<?php

namespace App\Http\Controllers;

use App\Models\Course;

class CourseController extends Controller
{
 public function show($slug)
 {
//   $course = Course::findOrFail($id);
//   $course = Course::with(['platform', 'topics', 'series'])->findOrFail($slug);
  $course = Course::where('slug', $slug)->with(['platform', 'topics', 'series', 'authors', 'reviews'])->first();

//   return \response()->json($course);

  if (empty($course)) {
   return \abort(404);
  }

  return \view('course.single', [
   'course' => $course,
  ]);

 }
}