@extends('layouts.app')
<script>
    function disable(num)
    {
        var x = document.getElementById(':'+num).checked;
        if(x)
        {
            document.getElementById(num).value = "-2";
            document.getElementById(num).style.display = 'none';
            document.getElementById(num).required = false;
        }
        else
        {
            document.getElementById(num).value = "";
            document.getElementById(num).required = true;
            document.getElementById(num).style.display = 'inline';
        }
    }
    </script>
<style>
          .card{
            /* height: 500px; */
            /* margin-top: 50px; */
            color: white;
            margin-bottom: auto;
            /* width: 400px; */
            background-color:rgba(0,0,0,0.7) !important;
            }
            table{
                color:white;
            }
            th{
                color:yellow;
            }
            .sub_btn{
            color: black;
            background-color: #FFC312;
            width: 90px;
            margin-top: 10px;
            }
            
            .sub_btn:hover{
            color: black;
            background-color: white;
            }
</style>
@section('content')
<div class="col-12">
        <div class="card" style="margin-top:20px">
            <div class="card-body">
         <div class="row ">
                                <div class="col-md-12 text-md-left">
                                    <h4 >Update Marks </h4>
                                   <hr style="border:1px solid #FFC312"> 
                                </div>
                            </div>
                <div class="table-responsive">
                        <form method= "POST" >
                                @csrf
                    <table id="zero_config" class="table table-striped table-bordered">
                        <thead style="text-align:center;">
                        <tr>
                            {{-- <th rowspan="2">S.N.</th> --}}
                            <th rowspan="2">Roll No</th>
                            <th rowspan="2">Student Name</th>
                            <th colspan="5" >Term Work</th>
                        </tr>
                        @if($subject->subject!='AOA')    
                            <tr>
                                <th>Attendance</th>
                                <th>File</th>
                                <th>Mini Project</th>
                                <th>Total</th>
                                <th>Edit</th>
                            </tr>
                        @else
                        <tr>
                            <th>Attendance</th>
                            <th>File</th>
                            <th>Total</th>
                            <th>Edit</th>
                        </tr>
                        @endif
                        </thead>
                        <tbody>
                        @foreach($students as $student)
                            @if($subject->subject!='AOA')
                                <tr>
                                    {{-- <td>{{$loop -> index+1 }}</td> --}}
                                    <td>{{$student['rollno'] }}</td>
                                    <td>{{$student['full_name'] }}</td>
                                    <td>{{$student[$subject->subject.'_attendance'] }}</td>
                                    <td>{{$student[$subject->subject.'_file'] }}</td>
                                    <td>{{$student[$subject->subject.'_mini'] }}</td>
                                    <td>{{$student[$subject->subject.'_term'] }}</td>
                                    <td><a href="{{action('TeachersController@editTermWork',[$student['rollno'],$subject->subject] )}}" method="get" class="btn sub_btn" style="color:black;">Edit</a></td>
                                </tr>  
                            @else
                            <tr>
                                {{-- <td>{{$loop -> index+1 }}</td> --}}
                                <td>{{$student['rollno'] }}</td>
                                <td>{{$student['full_name'] }}</td>
                                <td>{{$student[$subject->subject.'_attendance'] }}</td>
                                <td>{{$student[$subject->subject.'_file'] }}</td>
                                <td>{{$student[$subject->subject.'_term'] }}</td>
                                <td><a href="{{action('TeachersController@editTermWork',[$student['rollno'],$subject->subject] )}}" method="get" class="btn sub_btn" style="color:black;">Edit</a></td>
                            </tr>
                            @endif
                                    {{-- <td>
                                        @if($test_no == 1)
                                            <input id = "{{$loop->index}}" value = "{{$student->ia1}}" type = "number" min = '-2' max = '30' name = "{{$student->id}}" required {{ $student->ia1 == -2 ?'style=display:none;': "" }}   ></td>
                                            <td><input id = ":{{$loop->index}}" type="checkbox" {{ $student->ia1 == -2 ? "checked" :"" }}  onchange = "disable({{$loop->index}})"></td>
                                        @elseif($test_no == 2)
                                            @if($student->ia2 == -1)
                                                <input  id = "{{$loop->index}}" type = "number" min = '-2' max = '30' name = {{$student->roll_no}} required></td>
                                                <td><input id = ":{{$loop->index}}"type="checkbox"  onchange = "disable({{$loop->index}})"></td>
                                            @else
                                                <input  id = "{{$loop->index}}" value = "{{$student->ia2}}" type = "number" min = '-2' max = '30' name = {{$student->id}} required {{ $student->ia2 == -2?'style=display:none;': "" }} ></td>
                                                <td><input id = ":{{$loop->index}}"type="checkbox" {{ $student->ia2 == -2 ? "checked" :"" }}  onchange = "disable({{$loop->index}})"></td>
                                            @endif
                                        @endif
                                --}}
                        @endforeach
                    </tbody>
                </table>
                <button type ="submit" class ="btn sub_btn" >Save<i class="fas fa-paper-plane"></i></button>
                    </form>
                    
                </div>
            </div>
        </div>
@endsection