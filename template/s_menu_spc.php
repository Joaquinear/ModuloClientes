<?php 



 ?>
<ul class="sidebar-menu">

    <?php 
    
   // if($_SESSION['rol']=="2" || $_SESSION['rol']=="3" )
    //{

    ?>

    	<!--- <li class="item-test"><a href="clientes.php"><i class="fa fa-list"></i><span>Gestion Lotes</span></a></li>    -->
        <li class="item-test"><a href="TraerClientes.php"><i class="fa fa-plus"></i><span>Gestion Clientes</span></a></li>
        <!--- <li class="item-test"><a href="ventas.php"><i class="fa fa-money"></i><span>Lotes vendido o reservados</span></a></li>-->
<?php //}?>

<?php 
    
    if($_SESSION['rol']=="2" )
    {
    ?>
        <!-- <li class="item-test"><a href="../rep/ventasxvendedores.php"><i class="fa fa-list"></i><span>Resportes</span></a></li>  -->
       
<?php }?>        

        
      

 		<!-- <li class="item-test"><a href="ventas.php"><i class="fa fa-money"></i><span>Gestion Clientes</span></a></li> -->
 



 	
        <!-- <li class="item-test"><a href="nueva.php"><i class="fa fa-plus"></i><span>A DEFINIR</span></a></li> -->

        
  
        
        <li class="header">Otros Módulos</li>
        <li class="item-test">
            <a href="#control-sidebar-stats-tab" id="opener" data-toggle="control-sidebar">
                <i class="fa fa-cube"></i><span>Modulos</span></a>
        </li>
    
    

    
</ul>


