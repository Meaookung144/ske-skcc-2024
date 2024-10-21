<?php
    require_once 'assets/api/conn.php';

    use voku\helper\AntiXSS;

    $antiXss = new AntiXSS();
    if(empty($_GET['name']) || empty($_GET['lic'])){
        $response['message'] = "empty key and payload";
        $response['status'] = "error";
    }else{
        $licc = $antiXss->xss_clean($_GET['lic']);
        $name = $antiXss->xss_clean($_GET['name']);
        
        $check_user = $conn->prepare("SELECT * FROM status WHERE name = :name");
        $check_user->bindParam(":name", $name);
        $check_user->execute();
        $row = $check_user->fetch(PDO::FETCH_ASSOC);
        if ($licc == "ske") {
            if(empty($_GET['status'])){
                
            }else{
                $status = $antiXss->xss_clean($_GET['status']);
                $update_data = $conn->prepare("UPDATE status SET status = :status WHERE name = :name");
                $update_data->bindParam(":status", $status);
                $update_data->bindParam(":name", $name);
                $update_data->execute();
                $status_update = $update_data->errorInfo()[0];
                if ($status_update != 0) {
                    $response['status'] = "error";
                    $response['message'] = "Database Error";
                }else{
                    $response['status'] = "success";
                    $response['message'] = $status;
                }
            }
        } else {
            $response['status'] = "error";
            $response['message'] = "Lic error";
        }
    }
    
echo json_encode($response);
?>