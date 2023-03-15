<div class="col-md-3 left_col menu_fixed">
    <div class="left_col scroll-view">
       
        <div class="clearfix"></div>

        <!-- menu profile quick info -->
        <div class="profile clearfix">
            <div class="profile_pic">
                <img src="build/images/User.png" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
                <span class="">BIENVENIDO/A</span>
                <span class=""> <?php  echo $_SESSION['nameUser']?></span>
            </div>
        </div>
        <!-- /menu profile quick info -->

        <br />

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <h3>MODULOS</h3>
                <ul class="nav side-menu">
                <?php  if($_SESSION['rolId']==1){?>
                    <li><a href="<?php echo getUrl("Usuario","Usuario","consult");?>"><i class="fa fa-file"></i>Crear capacitación</a></li>
                    <?php } ?>
                    <?php  if($_SESSION['rolId']==2){?>
                    <li><a href="<?php echo getUrl("Usuario","Usuario","CuposConsult");?>"><i class="fa fa-user"></i>Capacitaciones</a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</div>