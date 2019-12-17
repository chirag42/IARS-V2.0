<?php
use Illuminate\Support\Facades\DB;
function term_marks($var)
{
    if ($var < 50.0){
        return 0;
    }

    if ($var >= 50.0 && $var <= 60.0){
        return 1;
    }
    else if ($var > 60.0 && $var <= 70.0){
        return 2;
    }
    else if ($var > 70.0 && $var <= 80.0){
        return 3;
    }
    else if ($var > 80.0 && $var <= 90.0){
        return 4;
    }
    else if ($var > 90.0 && $var <= 100.0){
        return 5;
    }
}
$link = mysqli_connect("localhost", "root","","iars_final");

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
$tab_name = $year."_".strtolower($divisionr['class'])."_termwork";
$infile   = $subjectr['subject']."_file";
$inmini   = $subjectr['subject']."_mini";
$inatt    = $subjectr['subject']."_attendance";
$interm   = $subjectr['subject']."_term";

$excel = \PhpOffice\PhpSpreadsheet\IOFactory::load($data);
$excel->setActiveSheetIndex(0);
if($subjectr['subject'] == 'PYTHON')
    {
        $test=0;
        $i=2;
        DB::beginTransaction();
        while( $excel->getActiveSheet()->getCell('A'.$i)->getValue() != ""){
                
                $roll       =	$excel->getActiveSheet()->getCell('A'.$i)->getValue();
                $name       =	$excel->getActiveSheet()->getCell('B'.$i)->getValue();
                $file_grade =   $excel->getActiveSheet()->getCell('C'.$i)->getValue();
                $mini_proj  =   $excel->getActiveSheet()->getCell('D'.$i)->getValue();
                $att        =   $excel->getActiveSheet()->getCell('E'.$i)->getValue();
                if($att>100 || $file_grade>10 || $mini_proj>10){
                    $test=1;
                    break;
                }
                if($att=="" || $att=='0'){
                    $mini_proj=0;
                    $file_grade=0;
                    $att=0;
                }
                $term       =   term_marks($att) + $file_grade + $mini_proj;

                $sql = "UPDATE ".$tab_name." SET ".$infile." = '$file_grade' , ".$inmini." = '$mini_proj' , ".$inatt." = '$att' , ".$interm." = '$term' WHERE full_name = '$name'";

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
    }
elseif($subjectr['subject'] == 'AOA')
    {
        $test=0;
        $i=2;
        DB::beginTransaction();
        while( $excel->getActiveSheet()->getCell('A'.$i)->getValue() != ""){
                
                $roll       =	$excel->getActiveSheet()->getCell('A'.$i)->getValue();
                $name       =	$excel->getActiveSheet()->getCell('B'.$i)->getValue();
                $file_grade =   $excel->getActiveSheet()->getCell('C'.$i)->getValue();
                $att        =   $excel->getActiveSheet()->getCell('D'.$i)->getValue();
                if($att>100 || $file_grade>20){
                    $test=1;
                    break;
                }
                if($att=="" || $att=='0'){
                    $file_grade=0;
                    $att=0;
                }
                $term   =   term_marks($att) + $file_grade ;
                


                $sql = "UPDATE ".$tab_name." SET ".$infile." = '$file_grade' , ".$inatt." = '$att' , ".$interm." = '$term' WHERE full_name = '$name'";

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
}
else
    {
        $test=0;
        $i=2;
        DB::beginTransaction();
        while( $excel->getActiveSheet()->getCell('A'.$i)->getValue() != ""){
                
                $roll       =	$excel->getActiveSheet()->getCell('A'.$i)->getValue();
                $name       =	$excel->getActiveSheet()->getCell('B'.$i)->getValue();
                $file_grade =   $excel->getActiveSheet()->getCell('C'.$i)->getValue();
                $mini_proj  =   $excel->getActiveSheet()->getCell('D'.$i)->getValue();
                $att        =   $excel->getActiveSheet()->getCell('E'.$i)->getValue();
                if($att>100 || $file_grade>15 || $mini_proj>5){
                    $test=1;
                    break;
                }
                if($att=="" || $att=='0'){
                    $mini_proj=0;
                    $file_grade=0;
                    $att=0;
                }
                $term       =   term_marks($att) + $file_grade + $mini_proj;

                $sql = "UPDATE ".$tab_name." SET ".$infile." = '$file_grade' , ".$inmini." = '$mini_proj' , ".$inatt." = '$att' , ".$interm." = '$term' WHERE full_name = '$name'";

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
    }
      header("Location: " . URL::to('/teacher'), true, 302);
      exit();


?>