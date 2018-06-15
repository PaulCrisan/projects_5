<?php
define("VISIT" , 1 , false); // define a constant as exercise false for case sensitive
$rdmColor = "";


// get nr from file and update
$visits = file_get_contents("counter.txt");
file_put_contents("counter.txt", $visits + VISIT );

// get ajax request and manipulate
  if(isset($_POST['reset'])){
  file_put_contents("counter.txt", VISIT );
    }

//verify number of visits and keep color in between 7 visits
  if($visits % 7 == 0){
    $rdmColor = getRandomColor();
    file_put_contents("colors.txt" , $rdmColor."\n" , FILE_APPEND);
  }else {
    $colors_file_content = file_get_contents("colors.txt");
    // check at start when colors.txt is empty
    if(strlen($colors_file_content) > 2){
      $tempArray = array();
      $tempArray = explode("\n", $colors_file_content);
      $rdmColor = $tempArray[count($tempArray)-2];
    }else {
      $rdmColor = getRandomColor();
      file_put_contents("colors.txt" , $rdmColor."\n" , FILE_APPEND);
    }

  }

//get random color
  function getRandomColor(){
    $rgbColor = array();
    foreach(array('r', 'g', 'b') as $color){
    $rgbColor[$color] = rand(0, 255);
    }
    $colorRandom = implode(',', $rgbColor);
    return $colorRandom;
  }

 ?>

 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title></title>
     <style media="screen">
       .container{

              margin-top: 200px;
              display: flex;
              flex-direction: column;
              justify-content: center;

       }
       .align{
         align-self: center;
       }
       .buton{
         align-self: center;
       }
     </style>
   </head>
   <body style="background-color:rgb(<?php echo $rdmColor ?>)">
     <div class="container">
       <h1 class="counter" style="font-size:50px; text-align: center"><?php echo $visits ?></h1>
       <h1 class="counter align">VISITS</h1>
       <button type="button" class="buton align" onclick="reset()" name="button">RESET</button>
       <h1 class="flag align"></h1>
     </div>

     <script
       src="https://code.jquery.com/jquery-3.3.1.min.js"
       integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
       crossorigin="anonymous"></script>
     <script type="text/javascript">
     // ajax request for reset button
       function reset(){
         $.ajax({
            url: 'visitor_counter.php',
            type: 'post',
            data: { "reset": "1"},
            success: function() {
              document.getElementsByClassName('flag')[0].innerHTML = "counter reset";
            }
        });
       }
     </script>
   </body>
 </html>
