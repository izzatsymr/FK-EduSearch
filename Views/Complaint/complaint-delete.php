<?php
// Check if the complaintId is provided via POST request
if (isset($_POST['complaintId'])) {
    $complaintId = $_POST['complaintId'];

    // Connect to MySQL server
    $mysql = mysqli_connect("localhost", "root", "") or die(mysqli_connect_error());

    // Select the database named "fkedusearch"
    mysqli_select_db($mysql, "fkedusearch") or die(mysqli_error($mysql));

    // Query to fetch the status of the complaint with the provided complaintId
    $query = "SELECT status FROM complaints WHERE id = '$complaintId'";
    $result = mysqli_query($mysql, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $status = $row["status"];

        if ($status === "resolved") {
            // Delete the complaint if the status is "resolved"
            $deleteQuery = "DELETE FROM complaints WHERE id = '$complaintId'";
            $deleteResult = mysqli_query($mysql, $deleteQuery);

            // Check if the deletion was successful
            if ($deleteResult) {
                $deleteMsg = "Complaint deleted successfully.";
            } else {
                $deleteMsg = "Failed to delete the complaint.";
            }
        } else {
            $deleteMsg = "Cannot delete the complaint. Status is not 'resolved'.";
        }
    } else {
        $deleteMsg = "Complaint not found.";
    }

    // Close the database connection
    mysqli_close($mysql);
} else {
    $deleteMsg = "Complaint ID not provided.";
}

// Redirect back to the complaint list page
header("Location: complaint-list.php?deleteMsg=" . urlencode($deleteMsg));
exit();
