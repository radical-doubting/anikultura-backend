<!---?php
session_start();

// initializing variables
//$id = "";
$assigned_farmschool  = "";
$assigned_site  = "";
$number_seeds  = "";
$farmers = "";

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'anikultura');

// ADD CAMPAIGN
if (isset($_POST['add_batch']))
{
	
	
    // receive all input values from the form
    //$id = mysqli_real_escape_string($db, $_POST['title']);
    $assigned_farmschool = mysqli_real_escape_string($db, $_POST['school_name']);
	$assigned_site = mysqli_real_escape_string($db, $_POST['site']);
	$number_seeds = mysqli_real_escape_string($db, $_POST['seedlings']);
	$farmers = mysqli_real_escape_string($db, $_POST['farmer_name']);
	
	
    $query = "INSERT INTO `batch`(`assigned_farmschool_name`, `assigned_site`, `number_seeds_distributed`, `farmer_names`)
            VALUES('$assigned_farmschool','$assigned_site', '$number_seeds', '$farmers')";
    mysqli_query($db, $query); //Stores the submitted data in the database

	
}

?>-->

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <title>Create Batch</title>
        @livewireStyles
    </head>

    <body>
        @livewire('create-batch')
        @livewireScripts
    </body>
</html>
