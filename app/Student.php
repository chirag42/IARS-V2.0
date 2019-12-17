<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent;
use App\Notifications\TeacherResetPasswordNotification;
class Student extends Model
{
    
    protected $guard = 'student';

    protected $fillable = [
        'rollno', 'full_name', 'AOA_attendance','AOA_file','AOA_term','COA_attendance','COA_file','COA_mini','COA_term'
    ];
    protected $table = '2017_d7b_termwork';
    protected $primaryKey = 'rollno';
}
