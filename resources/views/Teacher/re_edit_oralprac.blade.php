@extends('layouts.app1')
<style>
  .card{
            color:white;
            height: 550px;
            margin-top: 50px;
            margin-left: 70px;
            margin-bottom: auto;
            width: 600px;
            background-color:rgba(0,0,0,0.7) !important;
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

{{-- <script type="text/javascript">
    function populate(){
        document.getElementById('sub').options.length = 0;
        document.getElementById('sub').disabled = false;
        var users = {!! json_encode($details) !!};
        var div = document.getElementById('div').value;
        for(i = 0; i<users.length; i++){
            
            if(div == users[i]['division_id']){
                var newOption = document.createElement("option");
                newOption.value = users[i]['subject']['id'];
                newOption.innerHTML = users[i]['subject']['subject'];
                sub.options.add(newOption);
            }
        }
    }
</script> --}}

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="margin-top: 40px;">
                <div class="card-body">
                        <div class="row ">
                                <div class="col-md-12 text-md-left">
                                    <h4 >Edit OralPractical Marks</h4>
                                   <hr style="border:1px solid #FFC312"> 
                                </div>
                            </div>
                     <form  action="{{action('TeachersController@updateOralPrac',[$oral['rollno'],$subject])}}" enctype="multipart/form-data" method="POST">
                     @csrf
                    {{-- <input type="hidden" name="_method" value="POST"/> --}}
                    <div class="form-group">
                        <p>Roll No.: {{ $oral['rollno'] }}</p>
                    </div>
                    
                    <div class="form-group">
                        <p>Full Name: {{ $oral['full_name'] }} </p>
                    </div> 

                    <div class="form-group">
                        <label>Marks: </label><input type="text" name="Marks" class="form-control" value="{{ $oral[$subject.'_marks'] }}" placeholder="Enter Marks">
                    </div>
                    <button type ="submit" class ="btn sub_btn" >Save<i class="fas fa-paper-plane"></i></button>
                     </form>
                </div>
            </div>
        </div>
    </div>
</div>

        
@endsection
@if ($errors->any())    
    <ul>
    @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
    </ul>
@endif
