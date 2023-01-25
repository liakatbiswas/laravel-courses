<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
 use HasFactory;

 // One to One Relation
 public function submittedBy()
 {
  return $this->belongsTo(User::class, 'submitted_by');
 }

 // One to One Relation
 public function platform()
 {
  return $this->belongsTo(Platform::class);
 }

//  Multiple Relation
 public function topics()
 {
  return $this->belongsToMany(Topic::class, 'course_topic', 'course_id', 'topic_id');
 }
//  Multiple Relation
 public function authors()
 {
  return $this->belongsToMany(Author::class, 'course_author', 'course_id', 'author_id');
 }
 public function series()
 {
  return $this->belongsToMany(Series::class, 'course_series', 'course_id', 'series_id');
 }

 /**
  * If you need to make a one to many relationship (a user can make many comments and a
  * comment is associated to only one user) you can use a hasMany. BelongsToMany is for
  * many to many relationship (for example a user have many roles and a role is associated
  * to many users).
  */

 public function reviews()
 {
  return $this->hasMany(Review::class);
 }

 public function duration($value)
 {
  if ($value == 1) {
   return "5-10 hours";
  } elseif ($value == 2) {
   return "10+ hours";
  } else {
   return "1-5 hours";
  }
 }

 public function dificulty_lavel($lavel)
 {
  if ($lavel == 1) {
   return 'Intermediate';
  } elseif ($lavel == 2) {
   return 'Advanced';
  } else {
   return 'Beginner';
  }
 }

}