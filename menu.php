<?php

    $pageData   = mysqli_query($conn, "SELECT * FROM powerbi_report_page_map WHERE client_id = $client_id and status = 1 and order_id = 1; ");

    while($data=mysqli_fetch_array($pageData)) {
                $def_page_id          = mysqli_real_escape_string($conn,$data['page_id']);
                $def_page_name        = mysqli_real_escape_string($conn,$data['page_name']);
            }
?>

<div class="nav-side-menu">
    <div class="brand hidden-lg hidden-md">Analytics</div>
    <i class="material-icons toggle-btn" data-toggle="collapse" data-target="#menu-content">menu</i>
    <div class="menu-list">
        <ul id="menu-content" class="menu-content collapse out">
            <div class="dropdown dd-menu">
              <a class="dropdown-toggle user-menu" type="button" data-toggle="dropdown">
                  <div class="logged-in"><i class="material-icons">person</i><span>Analytics</span></div>
                  <!--<span class="caret"></span>--></a>
                  <ul class="dropdown-menu">
                    <li><a href="../logout.php"><i class="material-icons">exit_to_app</i><span>Logout</span></a></li>
                  </ul>
            </div>



            <li><a href="../analytics.php"><i class="material-icons">apps</i><span>Reports</span><img src="img/sme_small.png" alt="Launch" class="active-app"></a></li>
            <!--<li><a href="#"><i class="material-icons">access_time</i><span>Realtime</span></a></li>-->

            <li><a href="#"><i class="material-icons">chrome_reader_mode</i><span>Analytics</span></a></li>
            <ul class="sub-nav">
                <h3>Adoption</h3>
<!--                <li><a href="aa_adoption.php">Adoption KPIs</a></li>-->
<!--                <li><a href="content.php">Content</a></li>-->


                <?php

                    $pageData   = mysqli_query($conn, "SELECT * FROM powerbi_report_page_map WHERE client_id = '1' and report_id = $rid and status = 1 ORDER BY order_id asc; ");

                    while($data=mysqli_fetch_array($pageData)) {
                                $page_name        = mysqli_real_escape_string($conn,$data['page_name']);
                                $page_id          = mysqli_real_escape_string($conn,$data['page_id']);
                                echo '<li><a href="?R=' . $rid . '&P=' . $page_id . '">' . $page_name . '</a></li>';
                                #echo '<li><a href="#?P=' . $page_id . '" data-target="config.php">' . $page_name . '</a></li>';

                            }

                ?>
<!--                <li><a href="aa_tactical.php">Interventions</a></li>-->

            </ul>

        </ul>
    </div>
    <img src="img/sme_small.png" alt="Logo" id="logo" class="hidden-xs"/>
</div>
