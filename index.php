<?php
$sk=0;
$lyg="";
$nelyg="";
$numb=0;
if(isset($_POST['numb'])){
$numb = $_POST['numb'] ;

}
while($numb != 0){
    $sk= $numb % 10 ;
    $numb = floor($numb / 10) ;
    if($sk % 2==0){
        $lyg++;
    }else{
        $nelyg++;
    }
}


// print_r($_FILES);

    $weatherSum=0;
    $total=0;
    $temperatures=[];
    $avarage='';
    $min='';
    $max='';


    if (isset($_FILES['info'])){


    $to='C:/xampp/htdocs/php-start/lyginiai-failu-paemimas/ikelimai/'.$_FILES['info']['name'];
    move_uploaded_file($_FILES['info']['tmp_name'], $to);
    $file=fopen($to,'r');


    while($skaicius= fgets($file)){
            $total++ ;
           $weatherSum+=$skaicius;
        array_push($temperatures,$skaicius);
        }



        $min = min($temperatures);
        $max = max($temperatures);
        $avarage = floor($weatherSum / $total);




    fclose($file);
    }
?>




<?php include "head.php" ?>

<div class="container ">
    <div class="row">
                <form class="col-md-6 d-flex flex-column align-items-center" method="post" >
                <div class="text-center mt-5 ">
                    <h1>Skaičiuoti kiek lyginių/nelyginių skaitmenų sudaro skaičių</h1>
                </div>
                <div class="card bg-warning col-md-8 mt-3">
                    <div class="card-header text-center">
                        <h2>Skaičiuoklė</h2>
                    </div>
                    <div class="card-body text-center">
                        <input class="form-control" type="text" name="numb" placeholder="Iveskite Skaičių">
                        <button class="btn btn-success mt-4">Skaičiuoti</button>
                    </div>
                    <div class="text-center">
                    <?= (($lyg > 0 || $nelyg> 0)?'<h4 class="text-success">Lyginiu skaičių '.$lyg.' ; Nelyginių skaičių '.$nelyg.'</h4>':"" ) ?>

                    </div>
                </div>
                </form>





        <div class="col-md-5 ">
            <div class="text-center mt-4 ">
                <h1>Isikelkite failą ir gaukite didžiausia skaičių esanti faile mažiausia ir skaičių vidurkį</h1>
            </div>


            <form method="post" enctype="multipart/form-data">


            <div class="card bg-danger mt-3">
                     <div class="card-header">
                   <h2>Ikelkite failą</h2>
                    </div>

                    <div class="card-body">
                    <input class="form-control mt-3" type="file" name="info">
                    <button class="btn btn-success mt-4" name="data" value="1">Tikrinti orus</button>

                    </div>
                <h5 class="text-warning text-center">
                <?= ($min > 0 || $max > 0 || $avarage > 0)?' Aukščiausia temperatūra '.$max.' Žemiausia temperatūra '.$min.' Temperatūrų vidurkis '.$avarage:"" ?>
</h5>
            </div>
            </form>


        </div>


     </div>
    </div>





<?php include "footer.php" ?>

