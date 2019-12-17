<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use App\DivisionTeacher;
use App\Subject;
use App\Application;
use App\Division;
use App\Teacher;
use App\Student;
use App\Oral;
use App\User;
use Illuminate\Support\Facades\DB;
use App\Mail\Email;
use Illuminate\Support\Facades\Mail;
use App\InternalTest;
class TeachersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showClassesSubjects()
    {
        $user = Auth::user();
        $details = DivisionTeacher::where('teacher_id',$user->id)->with('division')->with('subject')->get();
      //return $details;
        return view('Teacher.entermarks')->with('details',$details);
    }
    public function showClassesMarks()
    {
        $user = Auth::user();
        $details = DivisionTeacher::where('teacher_id',$user->id)->with('division')->with('subject')->get();
      //return $details;
        return view('Teacher.editmarksdash')->with('details',$details);
    }
    public function showmarks()
    {
    
        $user =Auth::user();
        $details = DivisionTeacher::where('teacher_id',$user->id)->with('division')->with('subject')->get();
        //return $details;
        return view('Teacher.home')->with('details',$details);


    //     $user = Auth::user();
    //     $details = DivisionTeacher::where('teacher_id',$user->id)->with('division')->with('subject')->get();
    //   //return $details;
    //     return view('Teacher.putMarks')->with('details',$details);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createSessionForTeacher(Request $request)
    {
        $teacher = Auth::user();
        $request->session()->put('subject_no'.$teacher->id,$request['subject_no']);
        $request->session()->put('division_no'.$teacher->id,$request['division_id']);
        $request->session()->put('test_no'.$teacher->id,$request['test_no']);
        return redirect('teacher/studentmarks');
    }
    public function showStudents()
    {   
        $teacher = Auth::user();
        $search = 'Expiry_'.session()->get('test_no'.$teacher->id,'Error');
        $expiry = DivisionTeacher::where('teacher_id',$teacher->id)->where('subject_id',session()->get('subject_no'.$teacher->id,'Error'))->value($search);
        if(!isset($expiry))
        {
            $teacher = Auth::user(); 
            $test_no = session()->get('test_no'.$teacher->id,'Error');
            $students = User::where('division',session()->get('division_no'.$teacher->id,'Error'))->orderBy('roll_no')                       
                                ->get();
            return view('Teacher.entermarks')->with('students',$students)->with('test_no',$test_no);
        }
        else
        {
            return redirect('teacher/entermarks')->with('error','You have already entered marks for this subject, test and division combination. If you wish to edit them kindly go to edit marks.');
        }
    }
    public function insert()
    {
        return 'hello';
    }
    public function entermarks()
    {
        $teacher = Auth::user();
        $search = 'Expiry_'.session()->get('test_no'.$teacher->id,'Error');
        $expiry = DivisionTeacher::where('teacher_id',$teacher->id)->where('subject_id',session()->get('subject_no'.$teacher->id,'Error'))->value($search);
        if(!isset($expiry))
        {
            $teacher = Auth::user();
            $test_no = session()->get('test_no'.$teacher->id,'Error');
            $students = User::where('division',session()->get('division_no'.$teacher->id,'Error'))->orderBy('roll_no')                       
                                ->get();
            return view('Teacher.putmarks')->with('students',$students)->with('test_no',$test_no);
        }
        else
        {
            return redirect('teacher/putmarks')->with('error','You have already entered marks for this subject, test and division combination. If you wish to edit them kindly go to edit marks.');
        }
    }
    public function showTestThree()
    {
        $teacher = Auth::user();
        $students = Application::where('status','1')->where('teacher_id',$teacher->id)->with('user:id,name,roll_no,division')->with('division')->with('subject:id,subject')->get();
        return view('Teacher.test3')->with('students',$students);
    }
    public function showTermwork()
    {      
        $user =Auth::user();
        $details = DivisionTeacher::where('teacher_id',$user->id)->with('division')->with('subject')->get();
        //return $details;
        return view('Teacher.termwork')->with('details',$details);
    }
    public function sendsubject1()
    {      
        $user =Auth::user();
        $details = DivisionTeacher::where('teacher_id',$user->id)->with('division')->with('subject')->get();
        //return $details;
        return view('Teacher.selectsubject')->with('details',$details)->with('idno','1');
    }
    public function sendsubject2()
    {      
        $user =Auth::user();
        $details = DivisionTeacher::where('teacher_id',$user->id)->with('division')->with('subject')->get();
        //return $details;
        return view('Teacher.selectsubject')->with('details',$details)->with('idno','2');
    }

    public function oral_prac()
    {      
        $user =Auth::user();
        $details = DivisionTeacher::where('teacher_id',$user->id)->with('division')->with('subject')->get();
        //return $details;
        return view('Teacher.oral_prac')->with('details',$details);

    }
    public function insert_oral_prac(Request $request){
        $data = $request->file('excel');
        $user =Auth::user();
        $sub = $request['subject_no'];
        $div = $request['division_id'];
        $year = $request['year'];


        return view ('Teacher.insert_oral_prac',compact('data','div','sub','year'));
    }


    public function storeTestThree(Request $request)
    {
        $teacher = Auth::user();
        $students = Application::where('teacher_id',$teacher->id);
        $data = array();
        foreach($_POST as $roll=>$mark)
        { 
            if(is_numeric($roll))
            {
               
                 $data[$roll] = $mark;
            }
        }
        $this->updateTestThreeValues($data);
        return redirect('/teacher/test3')->with('success','Marks Entered successfully!');
    }
    public function displaytermworkOP(Request $request)
    {
        if($request->get('idno')==1){
        $subject = Subject::where('id',$request->subject_no)->first();
        if($subject->subject !='AOA') 
            $students = Student::select('rollno','full_name',$subject->subject.'_file',$subject->subject.'_mini',$subject->subject.'_attendance',$subject->subject.'_term')->orderBy('rollno','ASC')->get();
        else
            $students = Student::select('rollno','full_name',$subject->subject.'_file',$subject->subject.'_attendance',$subject->subject.'_term')->orderBy('rollno','ASC')->get();
        return view('teacher.editmarkslist')->with('students',$students)->with('subject',$subject); 
        }
        else
        {
            $subject = Subject::where('id',$request->subject_no)->first();
            $orals = Oral::select('rollno','full_name',$subject->subject.'_marks')->orderBy('rollno','ASC')->get();
            // if($subject->subject !='AOA') 
            //     $orals = Oral::select('rollno','full_name',$subject->subject.'_marks')->orderBy('rollno','ASC')->get();
            // else
            //     $students = Student::select('rollno','full_name',$subject->subject.'_file',$subject->subject.'_attendance',$subject->subject.'_term')->orderBy('rollno','ASC')->get();
            return view('teacher.editoralprac')->with('orals',$orals)->with('subject',$subject); 
        }
    }
    public function editTermWork($rollno,$subject){
    
        //$subject = Subject::where('id',$request->subject_no)->first();
    
        // $student = Student::find($rollno);
        if($subject =='AOA')
            $student = Student::select('rollno','full_name',$subject.'_file',$subject.'_attendance',$subject.'_term')->where('rollno',$rollno)->first();
        else
            $student = Student::select('rollno','full_name',$subject.'_file',$subject.'_attendance',$subject.'_mini',$subject.'_term')->where('rollno',$rollno)->first();
        
        //return $student;
        //$user = Auth::user();
        //$details = DivisionTeacher::where('teacher_id',$user->id)->with('division')->with('subject')->get();
        


        return view('teacher.editterm')->with('student',$student)->with('subject',$subject);


        // $sub = $request['id'];
        // $roll = $request['rollno'];
        
        //return $subject;
    

    }

    public function editOralPrac($rollno,$subject){
    
        //$subject = Subject::where('id',$request->subject_no)->first();
    
        // $student = Student::find($rollno);
        $oral = Oral::select('rollno','full_name',$subject.'_marks')->where('rollno',$rollno)->first();
        
        //return $student;
        //$user = Auth::user();
        //$details = DivisionTeacher::where('teacher_id',$user->id)->with('division')->with('subject')->get();
        


        return view('teacher.re_edit_oralprac')->with('oral',$oral)->with('subject',$subject);


        // $sub = $request['id'];
        // $roll = $request['rollno'];
        
        //return $subject;
    

    }

    public function updateterm(Request $request,$rollno,$subject)
    {
        
        //return $request;
        $student = Student::find($rollno);
        
        if($subject !='AOA'){
            $student[$subject.'_attendance'] = $request->get('Attendance');
            $student[$subject.'_file']  = $request->get('File');
            $student[$subject.'_mini']  = $request->get('Mini');
            $student[$subject.'_term']  = $request->get('Total');
        }
        else{
         $student[$subject.'_attendance'] = $request->get('Attendance');
         $student[$subject.'_file']  = $request->get('File');
         $student[$subject.'_term']  = $request->get('Total');
         }  

        $student->save();
        return redirect()->back()->with('success','Marks Updated');
    }

    public function updateOralPrac(Request $request,$rollno,$subject)
    {
        
        //return $request;
        $oral = Oral::find($rollno);
        $oral[$subject.'_marks'] = $request->get('Marks');
        $oral->save();
        return redirect()->back()->with('success','Marks Updated');
    }

    public static function updateTestThreeValues(array $values)
    {
        $table = Application::getModel()->getTable();
        $cases = [];
        $ids = [];
        foreach ($values as $id => $value) {
            $id = (int) $id;
            $cases[] = "WHEN {$id} then $value";
            $ids[] = $id;
        }
        $ids = implode(',', $ids);
        $cases = implode(' ', $cases);
        return \DB::update("UPDATE `{$table}` SET `marks` = CASE `id` {$cases} END WHERE `id` in ({$ids})");
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $data = array();
        $subject_id = $request->session()->get('subject_no'.$user->id,'Error');
        $division_id = $request->session()->get('division_no'.$user->id,'Error');
        if($request->session()->get('test_no'.$user->id) == '1')
        {
            foreach($_POST as $id=>$mark)
            {
                if(is_numeric($id))
                {
                        $data[] = array( 'student_id' => $id, 
                                         'division_id' => $division_id, 
                                         'subject_id' => $subject_id, 
                                         'IA1' => $mark,
                                           'status1'=> 0,
                                           'IA2' => -1, 
                                           'status2' => 0,
                                           'Avg' => -1);
                }
            }
            InternalTest::insert($data);
            $divtoteacher = DivisionTeacher::where('teacher_id',$user->id)
                                            ->where('division_id',$request->session()->get('division_no'.$user->id,'Error'))
                                            ->where('subject_id',$request->session()->get('subject_no'.$user->id,'Error'))->first();
            $divtoteacher->Expiry_1 = now()->addHours(48);
            $divtoteacher->save();
        }
        else if($request->session()->get('test_no'.$user->id) == '2')
        {
            $table = InternalTest::getModel()->getTable();
            $cases = [];
            $ids = [];
            foreach($_POST as $id=>$mark)
            {
                if(is_numeric($id))
                {
                    $id = (int) $id;
                    $cases[] = "WHEN {$id} then $mark";
                    $ids[] = $id;
                }
            }
                $ids = implode(',', $ids);
                $cases = implode(' ', $cases);
                // If student is absent for any test, set his average to 0
                \DB::update("UPDATE `{$table}` SET `IA2` = CASE `student_id` {$cases} END, `Avg`= CASE WHEN `IA1` = -2 THEN 0 WHEN `IA2` = -2 THEN 0 ELSE CEIL((`IA1`+`IA2`)/2) END WHERE `student_id` in ({$ids})");
            
            $divtoteacher = DivisionTeacher::where('teacher_id',$user->id)
                                             ->where('division_id',$request->session()->get('division_no'.$user->id,'Error'))
                                             ->where('subject_id',$request->session()->get('subject_no'.$user->id,'Error'))->first();
            $divtoteacher->Expiry_2 = now()->addHours(48);
            $divtoteacher->save();  
        }
        $subject = Subject::where('id',$subject_id)->first()->value('subject');
        $division = Division::where('id',$division_id)->first();
        session()->forget(['division_no'.$user->id, 'subject_no'.$user->id,'test_no'.$user->id]);
      //  return redirect('teacher/putmarks');
        return $this->send($subject,$division);
    }
  
    public function editMarks()
    {
        $user = Auth::user();
        $details = DivisionTeacher::where('teacher_id',$user->id)->with('division')->with('subject')->get();
        return view('Teacher.editmarks')->with('details',$details);
    }
    public function editMarksCreateSession(Request $request)
    {
        $teacher = Auth::user();
        $request->session()->put('subject_no'.$teacher->id,$request['subject_no']);
        $request->session()->put('division_no'.$teacher->id,$request['division_id']);
        $request->session()->put('test_no'.$teacher->id,$request['test_no']);
        return redirect('teacher/editmarkslist');
    }
    // public function storeMarks(Request $request)
    // {
    //     $teacher = Auth::user();
    //     $put = '';
    //     $test_no = session()->get('test_no'.$teacher->id,$request['test_no'],"Error");
    //     if($test_no == '1')
    //     {
    //         $put = 'ia1';
    //     }
    //     elseif($test_no == '2')
    //     {
    //         $put = 'ia2';
    //     }
    //         $table = InternalTest::getModel()->getTable();
    //         $cases = [];
    //         $ids = [];
    //         foreach($_POST as $id=>$mark)
    //         {
    //             if(is_numeric($id))
    //             {
    //                     $id = (int) $id;
    //                     $cases[] = "WHEN {$id} then $mark";
    //                     $ids[] = $id;
    //             }
    //         }
    //         $ids = implode(',', $ids);
    //         $cases = implode(' ', $cases);
    //         DB::update("UPDATE `{$table}` SET {$put} = CASE `id` {$cases} END WHERE `id` in ({$ids})");
    //         return redirect('teacher/editmarks')->with('success','You have edited marks successfully!!');
    // }
    public function showStudentList()
    {
        $teacher = Auth::user();
        $subject_id = session()->get('subject_no'.$teacher->id,'Error');
        $division_id = session()->get('division_no'.$teacher->id,'Error');
        $test_no = session()->get('test_no'.$teacher->id,'Error');
        $test = $test_no == 1 ? 'ia1':'ia2';
        
        $search = $test_no==1?'Expiry_1':'Expiry_2';
        $exists = DivisionTeacher::where('division_id',$division_id)
                                 ->where('subject_id',$subject_id)
                                 ->get();
        if(isset($exists))
        {
        $users = DB::select("select users.roll_no,users.name,internal_test.id,internal_test.".$test." FROM users INNER JOIN internal_test ON internal_test.student_id = users.id WHERE internal_test.division_id = ? AND internal_test.subject_id = ? ORDER BY internal_test.student_id"
                             ,[session()->get('division_no'.$teacher->id,'Error'),
                             session()->get('subject_no'.$teacher->id,'Error')]);
          return view('Teacher.editmarkslist')->with('users',$users)->with('test_no',$test_no);
        }
        else
        {
            return redirect('teacher/editmarks')->with('error',"You haven't put marks for this test of this subject yet.");
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function checkstatus()
    {
        $user = Auth::user();
        $details = DivisionTeacher::where('teacher_id',$user->id)->with('division')->with('subject')->get();
        return view('Teacher.oral_prac')->with('details',$details);
    }
    public function send($subject,Division $division)
    {
        $teacher = Auth::user();
        Mail::to($division['email'])
        ->cc($teacher->email)
        ->send(new Email($subject , $division));
       // return $this->index();
      // session()->forget(['division_no'.$user->id, 'subject_no'.$user->id,'test_no'.$user->id]);
      return redirect('teacher/putmarks');
        
    }
    public function status(Request $request)
    {
        $teacher = Auth::user();
        $request->session()->put('subject_no'.$teacher->id,$request['subject_no']);
        $request->session()->put('division_no'.$teacher->id,$request['division_id']);
        $request->session()->put('test_no'.$teacher->id,$request['test_no']);
        return redirect('teacher/status');
    }
    public function showStatus()
    {
        $teacher = Auth::user();
        $test_no = session()->get('test_no'.$teacher->id,"Error");
        $students =  DB::table('users')
                        ->join('internal_test', 'users.id', '=', 'internal_test.student_id')
                        ->join('divisions', 'users.division', '=', 'divisions.id')
                        ->select('users.name','users.name','users.roll_no', 'internal_test.*', 'divisions.*')
                        ->where('users.division',session()->get('division_no'.$teacher->id,'Error'))
                        ->orderBy('users.roll_no')
                        ->get();
        session()->forget(['division_no'.$teacher->id, 'subject_no'.$teacher->id,'test_no'.$teacher->id]);
        return view('Teacher.status')->with('students',$students)->with('test_no',$test_no);
    }
    public function show($id)
    {
    }
    public function marks(Request $request)
    {
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function term_insert(Request $request)
    {
        // return $request;
        $data = $request->file('excel');
        $user =Auth::user();
        $sub = $request['subject_no'];
        $div = $request['division_id'];
        $year = $request['year'];


        return view ('Teacher.term_insert',compact('data','div','sub','year'));
    }
}