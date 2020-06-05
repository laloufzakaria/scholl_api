<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class Timetable extends Model
{
    //

    use Notifiable;


    protected $fillable = [
        'teacher_subject_id', 'day_no', 'day_name', 'start_time', 'end_time', 'room_no', 'is_active'
    ];
}
