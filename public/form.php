<html>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'db.php';
?>

<body  bgcolor="green"  text="white">

<?php

$user_name = "root";
$password = "";
$database = "tahidihotel";
$host_name = "localhost"; 

$con=mysqli_connect($host_name, $user_name, $password, $database);


if(!$con) {
           die("Connection failed: " . mysqli_connect_error());
          }
echo "Connected successfully";

$n1=$_POST['fname'];
$n2=$_POST['lname'];
$n3=$_POST['phone'];
$n4=$_POST['email'];
$n5=$_POST['check_in_date'];
$n6=$_POST['check_in_month'];
$n7=$_POST['check_out_date'];
$n8=$_POST['check_in_month'];
$n9=$_POST['adults'];
$n10=$_POST['children'];
$n11=$_POST['suite'];


$sql = "INSERT INTO info (First_Name,Last_Name,Phone,Email,Check_In_Date,Check_In_Month,Check_Out_Date,Check_Out_Month,Adults,Children,Suite)
        VALUES ('$n1','$n2','$n3','$n4','$n5','$n6','$n7','$n8','$n9','$n10','$n11')";


if(mysqli_query($con, $sql)) {
                               echo "New record created successfully";
                             } 
else 
    {
    echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }

mysqli_close($con);

session_start();

// Initialize rooms if not already set
if (!isset($_SESSION['rooms'])) {
    $_SESSION['rooms'] = [
        ["roomNumber" => 101, "isAvailable" => true],
        ["roomNumber" => 102, "isAvailable" => true],
        // Add more rooms as needed
    ];
}

// Function to handle room booking
function bookRoom($customerName) {
    global $rooms;

    // Reference rooms from session
    $rooms = &$_SESSION['rooms'];

    foreach ($rooms as &$room) {
        if ($room['isAvailable']) {
            $room['isAvailable'] = false;

            $reservation = [
                "id" => uniqid(),
                "customerName" => $customerName,
                "roomNumber" => $room['roomNumber'],
                "ticket" => 'TICKET-' . uniqid()
            ];

            // Store reservation in session
            $_SESSION['reservations'][] = $reservation;

            return [
                "message" => "Room booked successfully!",
                "roomNumber" => $reservation["roomNumber"],
                "ticket" => $reservation["ticket"]
            ];
        }
    }

    return ["message" => "No rooms available"];
}

// Handle POST request for booking
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $customerName = $data['name'] ?? '';

    if (!empty($customerName)) {
        $response = bookRoom($customerName);
    } else {
        $response = ["message" => "Customer name is required"];
    }

    header('Content-Type: application/json');
    echo json_encode($response);
}
?>


hello world
</body>
</html>