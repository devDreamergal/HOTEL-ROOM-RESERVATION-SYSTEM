<?php
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