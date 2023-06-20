<?php
$conn = mysqli_connect("localhost", "root", "", "fkedusearch");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['type']) && isset($_POST['value'])) {
        $type = $_POST['type'];
        $value = $_POST['value'];

        switch ($type) {
            case 'research':
                $query = mysqli_query($conn, "DELETE FROM researches WHERE id = '$value'");
                if ($query) {
                    echo "Research deleted successfully.";
                } else {
                    echo "Error deleting research.";
                }
                break;

            case 'publication':
                $query = mysqli_query($conn, "DELETE FROM publications WHERE id = '$value'");
                if ($query) {
                    echo "Publication deleted successfully.";
                } else {
                    echo "Error deleting publication.";
                }
                break;

            case 'socmed':
                $query = mysqli_query($conn, "DELETE FROM socmed_accounts WHERE link = '$value'");
                if ($query) {
                    echo "Social media account deleted successfully.";
                } else {
                    echo "Error deleting social media account.";
                }
                break;

            default:
                echo "Invalid delete request.";
                break;
        }
    }
}
?>
