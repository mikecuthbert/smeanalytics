<?php

    // if (isset($_GET['R'])) { $rid = $_GET['R']; } else { $rid = '0'; }
    
        $active_session = $_COOKIE["active_session"];
        $u_sql        = mysqli_query($conn, "SELECT ul.user_id, ul.client_id
                                              FROM user_login ul
                                              JOIN user_powerbi_report_map prm ON ul.user_id = prm.user_id
                                              WHERE ul.active_session = '$active_session'
                                              AND ul.status = 1
                                              AND prm.status = 1
                                              AND prm.report_id = $rid;");

            while ($data = mysqli_fetch_array($u_sql)) {

                    $user_id            = mysqli_real_escape_string($conn, $data['user_id']);
                    $client_id          = mysqli_real_escape_string($conn, $data['client_id']);

            }


      if (isset($client_id)) {

       $api_query          = mysqli_query($conn, "SELECT * FROM powerbi_api WHERE status = 1;");

        while($data=mysqli_fetch_array($api_query)){

                    $api_url            = mysqli_real_escape_string($conn,$data['api_url']);
                    $api_client_id      = mysqli_real_escape_string($conn,$data['api_client_id']);
                    $api_client_secret  = mysqli_real_escape_string($conn,$data['api_client_secret']);
                    $api_resource       = mysqli_real_escape_string($conn,$data['api_resource']);
                    $api_username       = mysqli_real_escape_string($conn,$data['api_username']);
                    $api_password       = mysqli_real_escape_string($conn,$data['api_password']);

                }

                    $embed_report       = mysqli_query($conn, "SELECT pr.* FROM powerbi_report pr JOIN user_powerbi_report_map prm ON pr.id = prm.report_id
                                                                WHERE pr.client_id = $client_id and pr.id = $rid and pr.status = 1 and prm.status = 1
                                                                      and prm.user_id = $user_id; ");

        while($data=mysqli_fetch_array($embed_report)) {

                    $group_id           = mysqli_real_escape_string($conn,$data['group_id']);
                    $report_id          = mysqli_real_escape_string($conn,$data['report_id']);
                    $dataset_id         = mysqli_real_escape_string($conn,$data['dataset_id']);

                }

      }

      else {
          ?>
              <script>
                  alert("Report request not recognised, please contact support");
                  session_destroy(); //destroy the session
                  location.href =  'index.php';
              </script>
          <?php

      }

?>
