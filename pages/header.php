<?php echo'
<!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="../"><img src="./images/minahasa-logo.png" width="30px" style="float:left;margin-top:-5px;"> &nbsp;&nbsp;Sistem Informasi Manajemen Pajak Bumi dan Bangunan Minahasa</a>
            </div>
            <ul class="nav navbar-top-links navbar-right">
                      <li>
                        <a href="myaccount.php"> Halo, '.$_SESSION['NM_LOGIN'].' as '.$_SESSION['ROLE'].'
                            <i class="fa fa-user fa-fw"></i> 
                        </a>
                      </li>
                      <li><a href="../../logout.php?logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                              </li>
                  </ul>
	';?>
