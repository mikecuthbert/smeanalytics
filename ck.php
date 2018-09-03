<?php

    // This code controls the redirect based on the users role id

    if (isset($_SESSION["active_session"])) {

                setcookie("active_session",$_SESSION["active_session"],time()+86400*30);

                if(in_array($_SESSION["role_id"],array(3,11)))    { $output = 'partners.php'; }
                    else { $output = 'index.php'; }

                ?> <script> location.href = '<?= $output; ?>'; </script> <?php

                }

    else { ?> <script> location.href =  'index.php'; </script> <?php  }

?>
