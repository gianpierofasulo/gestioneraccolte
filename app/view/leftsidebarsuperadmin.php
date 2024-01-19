<?php
//error_reporting(E_ALL);
ini_set('display_errors', '1');
?>
<div class="sidebar sidebar-dark sidebar-fixed" id="sidebar">
      <div class="sidebar-brand d-none d-md-flex">
         <div class="col-12 text-center">
                <img src="img/logoavis.jpg" alt="AVIS RETE ASSOCIATIVA" width="180px">
                <p><small><?= $_SESSION['denominazione']; ?></small></p>
          </div>

         
      </div>
      <ul class="sidebar-nav" data-coreui="navigation" data-simplebar="">
        <li class="nav-item">
            <a class="nav-link" href="?page=layout">
            <svg class="nav-icon">
              <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-speedometer"></use>
            </svg> Dashboard
            </a>
           
        </li>
        
        <li class="nav-title">Menù</li>
        <li class="nav-group  <?php echo ($page == 'accessi' || $page == 'anagrafica' || $page == 'log_accessi' ? 'show' : ''); ?>
                            aria-expanded="<?php echo ($page == 'accessi' ? 'true' : 'false'); ?>" "><a class="nav-link nav-group-toggle" href="#">
            <svg class="nav-icon">
              <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-user"></use>
            </svg> Utenti</a>
          <ul class="nav-group-items">
            <li class="nav-item"><a class="nav-link  <?php echo ($page == 'accessi' ? 'active' : ''); ?>" href="index.php?page=accessi"><span class="nav-icon"></span> Password</a></li>
            <li class="nav-item"><a class="nav-link  <?php echo ($page == 'anagrafica' ? 'active' : ''); ?>" href="index.php?page=anagrafica"><span class="nav-icon"></span> Anagrafica</a></li>
            <li class="nav-item"><a class="nav-link  <?php echo ($page == 'log_accessi' ? 'active' : ''); ?>" href="index.php?page=log_accessi"><span class="nav-icon"></span> Accessi</a></li>
          </ul>
        </li>
        
     <!--   <li class="nav-group <?php echo ($page == 'categorie_principali' || $page == 'categorie_secondarie' ? 'show' : ''); ?>
                            aria-expanded="<?php echo ($page == 'categorie_principali' ? 'true' : 'false'); ?>" ">
            <a class="nav-link nav-group-toggle" href="#">
            <svg class="nav-icon">
              <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-tags"></use>
            </svg> Categorie files</a>
          <ul class="nav-group-items">
            <li class="nav-item"><a class="nav-link <?php echo ($page == 'categorie_principali' ? 'active' : ''); ?>" href="index.php?page=categorie_principali"><span class="nav-icon"></span> Principali</a></li>
            <li class="nav-item"><a class="nav-link <?php echo ($page == 'categorie_secondarie' ? 'active' : ''); ?>" href="index.php?page=categorie_secondarie"><span class="nav-icon"></span> Sotto categorie</a></li>
           </ul>
        </li> -->

        <li class="nav-group <?php echo ($page == 'documenti_gestione' || 
                                         $page == 'documenti_vedi_caricamenti' ? 'show' : ''); ?>"><a class="nav-link nav-group-toggle" href="#">
            <svg class="nav-icon">
              <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-description"></use>
            </svg> Files</a>
          <ul class="nav-group-items">
            <li class="nav-item"><a class="nav-link <?php echo ($page == 'documenti_gestione' ? 'active' : ''); ?>" href="index.php?page=documenti_gestione"><span class="nav-icon"></span> Gestione</a></li>
            <!--  <li class="nav-item"><a class="nav-link <?php echo ($page == 'documenti_vedi_caricamenti' ? 'active' : ''); ?>" href="index.php?page=documenti_vedi_caricamenti"><span class="nav-icon"></span> Vedi caricamenti</a></li>
           <li class="nav-item"><a class="nav-link <?php echo ($page == 'catalogo_step_programmi_washing' ? 'active' : ''); ?>" href="index.php?page=catalogo_step_programmi_washing"><span class="nav-icon"></span> Step Programmi Washing</a></li>
            <li class="nav-item"><a class="nav-link <?php echo ($page == 'catalogo_programmi_washing' ? 'active' : ''); ?>" href="index.php?page=catalogo_programmi_washing"><span class="nav-icon"></span> Programmi Washing</a></li> -->
          </ul>
        </li>
        
        <li class="nav-group <?php echo ($page == 'associa_centri'
                                         ? 'show' : ''); ?>"><a class="nav-link nav-group-toggle" href="#">
            <svg class="nav-icon">
              <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-tags"></use>
            </svg> Associazione CTS</a>
          <ul class="nav-group-items">
            <li class="nav-item"><a class="nav-link <?php echo ($page == 'associa_centri' ? 'active' : ''); ?>" href="index.php?page=associa_centri"><span class="nav-icon"></span> Gestione</a></li>
            
            <!-- <li class="nav-item"><a class="nav-link <?php echo ($page == 'catalogo_programmi_washing' ? 'active' : ''); ?>" href="index.php?page=catalogo_programmi_washing"><span class="nav-icon"></span> Programmi Washing</a></li> -->
          </ul>
        </li>
        
        
     
        <li class="nav-item mt-auto"><a class="nav-link" href="#">
            <svg class="nav-icon">
              <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-description"></use>
            </svg> Docs</a></li>
     
      </ul>
      <!--<button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>-->
    </div>
