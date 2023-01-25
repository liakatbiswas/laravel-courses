<?php

namespace App\Http\Controllers;

use App\Models\Topic;

class TopicController extends Controller
{
 public function index($slug)
 {
  // এভাবে এই topic এর সকল পোস্ট দেখাবে
  // $topic = Topic::where('slug', $slug)->with('courses')->first();
  // এভাবে এই topic পেজিনেশন হবে
  $topic   = Topic::where('slug', $slug)->first();
  $courses = $topic->courses()->paginate(12);
//   return $topic;
  return \view('topic.single', [
   'topic'   => $topic,
   'courses' => $courses,
  ]);
 }
}