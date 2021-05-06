
<?php

    include_once ("../clases/parametros.php");

    $usuario=$_SESSION['IdTrabajador'];

    $sgc_usuario=mb_strtolower(@$_SESSION['IdTrabajador'], 'UTF-8');
    $sgc_nombre=mb_strtolower(@$_SESSION['nombre'], 'UTF-8');
    $sgc_Apellido=mb_strtolower(@$_SESSION['Apellido'], 'UTF-8');
    $sgc_perfil=mb_strtolower(@$_SESSION['perfil'], 'UTF-8');
    $sgc_local=mb_strtolower(@$_SESSION['salon'], 'UTF-8');

    $foto=@$_SESSION['foto'];
    $url="../dist/img/$foto";
    if((!file_exists($url))||($foto=="")){
        $foto="user0.png";
        echo " <!-- NOTA no existe $url  -->";
    }



?>
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="../spc/index.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b></b>PENTA SOLUCIÓN.</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>PENTA SOLUCIÓN.</b> PENTA SOLUCIÓN.</span>
    </a>
    
            <!-- Menu Toggle Button -->
          
              <!-- The user image in the navbar-->
   
           
  
             
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
           
            
   
    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
         <?php //  echo "<button style='position: absolute; bottom: 0; height:100%;' type=\"button\" class=\"btn btn-".$colorboton." btn-xs\" onclick=\"ActualizarEstadoEjecutivo();\"><b>".$descripcionboton."</b></button>";?>
       
   
      <!-- Navbar Right Menu -->
     
      <div class="navbar-custom-menu">

        <ul class="nav navbar-nav">



          <!-- Messages: style can be found in dropdown.less-->
        
          <!-- User Account Menu -->
    
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
    
              <img src="../dist/img/<?php echo $foto; ?>" class="user-image" alt="User Image">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs"><span style="text-transform: capitalize;"><?php echo $sgc_nombre ;?> <?php echo $sgc_Apellido; ?> </span></span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                <img src="../dist/img/<?php echo $foto; ?>" class="img-circle" alt="User Image">
                <p>
                  <span style="text-transform: capitalize;"><?php echo $sgc_nombre;?> <?php echo $sgc_Apellido; ?></span>
                  <small><span style="text-transform: capitalize;"><?php echo $sgc_perfil;?>&nbsp;<?php echo $sgc_local;?></span></small>
                </p>
              </li>
            <!-- Menu Body -->
            <!-- 
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Followers</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Sales</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Friends</a>
                  </div>
                </div>
                
              </li> 
            -->
            <!-- Menu Footer-->
              <li class="user-footer">
                
                <div class="col-md-12" style="text-align: center;">
                  <a href="../contenido/login.php" class="btn btn-default btn-flat">Cerrar Sesión</a>
                </div>
             <!--     <div align="center">
                  <a href="../examples/Manual_TPM.pdf" target="_blank" class="btn btn-link">Manual</a>
                </div> -->
              </li>
                 
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>

   
  
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="../dist/img/<?php echo $foto; ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><span style="text-transform: capitalize;"><?php echo $sgc_nombre; ?> <?php echo $sgc_Apellido; ?>  </span></p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online </a>
        </div>
      </div>

        <?php if(1==0){ ?>
      <!-- search form (Optional) -->
        <!--
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form> -->
      <!-- /.search form -->
        <?php } ?>
      <!-- Sidebar Menu -->
        
      <?php
        if(@$menu=="spc"){
            require_once "../template/s_menu_spc.php"; 
        }
        if(@$menu=="rep"){
            require_once "../template/s_menu_rep.php"; 
        }
	
      ?>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
          <script type="text/javascript">
      
      //function ActualizarEstadoEjecutivo()
      //{
       // <?php
        //if($_SESSION['inicializado'] == null)
       // {
        //  $estado="nulo";
       // }
        //else
        //{
//
  //      }
    //     ?>



      //}
    </script>