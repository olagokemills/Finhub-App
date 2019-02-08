<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tracker | Dashboard</title>

    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/font-awesome/css/font-awesome.css" rel="stylesheet">
  <link href="../assets/css/plugins/bootstrap-markdown/bootstrap-markdown.min.css" rel="stylesheet">
    <link href="../assets/css/animate.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">

</head>

<body>
    <div id="wrapper">
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element"> <span>
                            <img alt="image" class="img-square" src="../assets/img/profile_small.jpg" />
                             </span>
                    </div>
                    <div class="logo-element">
                        FN+
                    </div>
                </li>
                <li class="active">
                    <a href="panel.php"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span></a>
                     </li>
                <li>
                    <a href="#"><i class="fa fa-sitemap"></i> <span class="nav-label">Records</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        
                         <li>
                            <a href="view_records.php">View Records</a>
                        </li>
                    </ul>
                </li>

                 <li>
                    <a href="#"><i class="fa fa-sitemap"></i> <span class="nav-label">Users</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li>
                            <a href="view_users.php">View Users</a>
                            
                        </li>
                    </ul>
                </li>
            </ul>

        </div>
    </nav>

        <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
        <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
            <form role="search" class="navbar-form-custom" action="https://chuibility.github.io/inspinia/search_results.html">
                <div class="form-group">
                    <input type="hidden" hidden="" class="form-control" name="top-search" id="top-search">
                </div>
            </form>
        </div>
            <ul class="nav navbar-top-links navbar-right">
                <li>
                    <span class="m-r-sm text-muted welcome-message"><span class="text-danger"><?php echo $_SESSION['tracker_name'];?></span></span>
                </li>


                <li>
                    <a href="logout.php">
                        <i class="fa fa-sign-out"></i> Log out
                    </a>
                </li>
                <li>
                    <a class="right-sidebar-toggle">
                        <i class="fa fa-tasks"></i>
                    </a>
                </li>
            </ul>

        </nav>
    
        </div>