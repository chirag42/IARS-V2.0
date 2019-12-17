<?php
use Illuminate\Support\Facades\DB;
$link = mysqli_connect("127.0.0.1", "root", "","iars_final");

if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

    $sql = "SELECT class from divisions where id=".$div;

        $division = mysqli_query($link, $sql);

        if(!$division)
        {
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
        }
    
    $sql = "SELECT subject from subjects where id=".$sub;

            $subject = mysqli_query($link, $sql);

            if(!$subject)
        {
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
        }
$divisionr = $division->fetch_assoc();
$subjectr = $subject->fetch_assoc();

//Dynamic Entries data
$tab_name = $year."_".strtolower($divisionr['class'])."_oral_prac";
$infinal   = $subjectr['subject']."_marks";

$excel = \PhpOffice\PhpSpreadsheet\IOFactory::load($data);
$excel->setActiveSheetIndex(0);

$test=0;
$i=2;
DB::beginTransaction();
while( $excel->getActiveSheet()->getCell('A'.$i)->getValue() != "")
{
        $roll        =	$excel->getActiveSheet()->getCell('A'.$i)->getValue();
        $name        =	$excel->getActiveSheet()->getCell('B'.$i)->getValue();
        $final_grade =  $excel->getActiveSheet()->getCell('C'.$i)->getValue();
        if($final_grade>25){
            $test=1;
            break;
        }
        if($final_grade=="" || $final_grade=='0'){
            $final_grade=0;
        }
        $sql = "UPDATE ".$tab_name." SET ".$infinal." = '$final_grade' WHERE full_name = '$name'";
        //$sql = "INSERT INTO ".$tab_name." values ($roll,'$name',0,0,0,0,0)";

        $result = mysqli_query($link, $sql);

        if(!$result)
        {
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
        }

        $i++;     
}
if($test==0){
    DB::commit();
}
else{
    DB::rollBack();
}

header("Location: " . URL::to('/teacher'), true, 302);
      exit();


?>
