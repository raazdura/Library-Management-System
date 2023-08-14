<?php
    include '../includes/config.php';

    if(!empty($_GET["response"])) {
        $id = intval($_GET['id']);
        switch($_GET["response"]) {
            case "approve":
                $sql1 = "UPDATE requests SET status = 1 WHERE rq_id = $id";
                if (mysqli_query($conn, $sql1)) {
                    echo "response updated as approved";
                    header('Location: ../admin/requests.php?page=1');

                }
            break;
            case "disapprove":
                $sql1 = "UPDATE requests SET status = 2 WHERE rq_id = $id";
                if (mysqli_query($conn, $sql1)) {
                    echo "response updated as disapproved";
                    header('Location: ../admin/requests.php?page=1');
                }
            break;
        }
    }
?>