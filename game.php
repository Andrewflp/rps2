<?php
session_start();
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
}
 else {    header("location: login.php");
 }
include 'header.php';
require_once "config.php";
//set up the variables to store the data
$game = array('Rock', 'Paper', 'Scissors' );
$computer =rand(0,2);
$player = isset($_POST["human"]) ? $_POST['human']+0 : -1;
$playerchoise =  $computerchoise = $results =" ";
$username = $_SESSION["username"];
// check the players and computers choice and store the result to $result 
if ($player == -1 ) {
}
    else {

        if ($player == $computer) {
    $results = 'Tie';
}
if (($player == '0' && $computer == '1') || ($player == '1' && $computer == '2') || ($player == '2' && $computer =='0'))
{   $results = 'You Lost'; }
else if (($player == '0' && $computer == '2') || ($player == '1' && $computer == '0') || ($player == '2' && $computer =='1'))
{   $results = 'You Win'; }

$playerchoise = $game[$player];
$computerchoise = $game[$computer];

$sql = "INSERT INTO results (Username, result, selection, computer ) VALUES ('$username', '$results', '$playerchoise', '$computerchoise')";
if ($con->query($sql) === TRUE) {
  
} else {
    echo "Error: " . $sql . "<br>" . $con->error;
}

}
$db = mysqli_select_db($con, 'games') or die("Error " . mysqli_error($con)); //select DATABASE not table or 
    // $con is from config.php to start the connection  results is the name of the table

   $sql = mysqli_query($con, "SELECT * FROM results WHERE username = '$username' ");  
// result is the name of the colum thats store the result of the game

   while($row = mysqli_fetch_array($sql)) {
   $array_results[] = $row['result'];
   }
// take the data from array_results and use array_count_values to calculate win lost and tie numbers
$results_count = (array_count_values($array_results));



// to get data about how many times user select a spesific item??hand?stuff
$sql = mysqli_query($con, "SELECT * FROM results WHERE username = '$username' ");  
while($row = mysqli_fetch_array($sql)) {
   $selection_results[] = $row['selection'];
   }
$selection_results_count = (array_count_values($selection_results));


// to get data about how many times computer select a spesific item??hand?stuff
$sql = mysqli_query($con, "SELECT * FROM results WHERE username = '$username' ");  
   while($row = mysqli_fetch_array($sql)) {
   $computer_selection_results[] = $row['computer'];
   }
   $computer_selection_results_count = (array_count_values($computer_selection_results));



// ************************** converts Print_r to variables to use them down in html so i can style them better ******************
// print array $results_count with [the text i need here] to output only the count from the text i need


$player_rock_count = ($selection_results_count['Rock']);
$player_Paper_count = ($selection_results_count['Paper']);
$player_Scissors_count = ($selection_results_count['Scissors']);
// calculate total games played by adding all players selections
$total_games_played = ($player_Scissors_count + $player_Paper_count + $player_rock_count);


$player_rock_percent = (($player_rock_count * 100 )/$total_games_played);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rock Paper Scissors</title>
</head>
<body>




    
<div class="gameselection">
<form method="post">
<select name="human">
<option value="-1">Select</option>
<option value="0">Rock</option>
<option value="1">Paper</option>
<option value="2">Scissors</option>
</select>
<input type="submit" name="Play"value="Play">
<form>
  <button formaction="logout.php">Logout</button>
</form>
</div>

</form>
<?php

if ( $player == -1 ) {
    print "Please select a strategy and press Play.\n";

} 
?>
<div class = "allstats">
<div class ="result">
<p>You played:  <?php echo $playerchoise; ?></p>
<p>Computer played:  <?php echo $computerchoise; ?></p>
<p>Outcome was:  <?php echo $results; ?></p>
</div>


<div class ="user-pick-stats">
<p>Your Total Pick Stats are:</p>
<p>You played Rock <?php print_r ($selection_results_count['Rock'])?> times</p>
<p>You played Paper <?php print_r ($selection_results_count['Paper'])?> times</p>
<p>You played Scissors <?php print_r ($selection_results_count['Scissors'])?> times</p>
</div>



<div class ="user-total-game-stats">
<p>Your Total Stats are:</p>
<p> <?php echo "Total games Lost: " . $results_count['You Lost'];?></p>
<p> <?php echo "Total games Won: " . $results_count['You Win'];?></p>
<p> <?php echo "Total games in Tie: " . $results_count['Tie'];?></p>
</div>


<div class ="computer-pick-stats">
<p>Computer Total Pick Stats are:</p>
<p>Total Computer Rock Selection:  <?php  print_r ($computer_selection_results_count['Rock']);?></p>
<p>Total Computer Paper Selection:  <?php  print_r ($computer_selection_results_count['Paper']);?></p>
<p>Total Computer Scissors Selection:  <?php  print_r ($computer_selection_results_count['Scissors']);?></p>
</div>
</div>
</body>
</html>

,




