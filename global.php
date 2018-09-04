	<!-- script -->
    <!-- PowerBI js -->
    <script src="js/powerbi.js"></script>
    <script src="js/jquery.min.js"></script>

    <!-- styles -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/>
  	<link rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css"/>
  	<link rel="stylesheet" type="text/css" href="css/jquery-ui.min.css"/>
  	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/icon?family=Material+Icons"/>
  	<link rel="stylesheet" type="text/css" href="css/style.css"/>

    <!-- icons -->
    <link rel="icon" href="img/favicon.ico"/>

    <script>
        // dd add class to active page
        $(function(){
        var path = window.location.href.substr(window.location.href.lastIndexOf("/")+1);
        if ( path )
            $('ul li a[href$="' + path + '"]').attr('class', 'active');
        });
    </script>
