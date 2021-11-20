<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type = "text/css" href="css/style.css">
    <title>Rock Paper Scissors V2</title>

</head>
<?php
session_start();

include 'header.php';
require_once "config.php"; // connect to db

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
}
else {    header("location: login.php");
}
$username = $_SESSION["username"];


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
$sql = mysqli_query($con, "SELECT * FROM results");  
   while($row = mysqli_fetch_array($sql)) {
   $computer_selection_results[] = $row['computer'];
   }
   $computer_selection_results_count = (array_count_values($computer_selection_results));


// percent of played item


// ************************** converts Print_r to variables to use them down in html so i can style them better ******************
// print array $results_count with [the text i need here] to output only the count from the text i need


$player_rock_count = ($selection_results_count['Rock']);
$player_Paper_count = ($selection_results_count['Paper']);
$player_Scissors_count = ($selection_results_count['Scissors']);
// calculate total games played by adding all players selections
$total_games_played = ($player_Scissors_count + $player_Paper_count + $player_rock_count);


$player_rock_percent = (($player_rock_count * 100 )/$total_games_played);
echo $username;
echo number_format(($player_rock_percent));
echo " %";
echo "<br>";
echo "Total games Lost: " . $results_count['You Lost'] . " Total games Won: " . $results_count['You Win'] . " Total games in Tie: " . $results_count['Tie'];
echo "<br>";

print_r ($results_count['You Lost']);
echo "<br>";
echo "Total games Won: ";
print_r ($results_count['You Win']);
echo "<br>";
Echo "Total games in Tie: ";
print_r ($results_count['Tie']);
echo "<br>";
echo "Total Paper Selection: ";
print_r ($selection_results_count['Paper']);
echo "<br>";
echo "Total Scissors Selection: ";
print_r ($selection_results_count['Scissors']);
echo "<br>";
Echo "Total Rock Selection: ";
print_r ($selection_results_count['Rock']);
echo "<br>";

echo "Total Computer Paper Selection: ";
print_r ($computer_selection_results_count['Paper']);
echo "<br>";
echo "Total Computer Scissors Selection: ";
print_r ($computer_selection_results_count['Scissors']);
echo "<br>";
Echo "Total Computer Rock Selection: ";
print_r ($computer_selection_results_count['Rock']);
echo "<br>";




//*********************************************************************************************************************************** */



$con->close();















?>