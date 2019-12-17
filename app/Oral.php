<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent;
use App\Notifications\TeacherResetPasswordNotification;
class Oral extends Model
{
    protected $guard = 'oral';

    protected $fillable = [
        'rollno', 'full_name', 'AOA_marks','COA_marks','CG_marks','OS_marks','open_source_marks'];
    protected $table = '2017_d7b_oral_prac';
    protected $primaryKey = 'rollno';
}
