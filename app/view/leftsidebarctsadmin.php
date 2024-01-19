
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
       
        
   <!--       <li class="nav-group <?php echo ($page == 'esercenti_anagrafiche' ? 'show' : ''); ?>
                            aria-expanded="<?php echo ($page == 'esercenti_anagrafiche' ? 'true' : 'false'); ?>" ">
            <a class="nav-link nav-group-toggle" href="#">
            <svg class="nav-icon">
              <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-briefcase"></use>
            </svg> Esercenti</a>
          <ul class="nav-group-items">
            <li class="nav-item"><a class="nav-link <?php echo ($page == 'esercenti_anagrafiche' ? 'active' : ''); ?>" href="index.php?page=esercenti_anagrafiche"><span class="nav-icon"></span> Anagrafiche</a></li>
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
        
        
     
        <li class="nav-item mt-auto"><a class="nav-link" href="#">
            <svg class="nav-icon">
              <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-description"></use>
            </svg> Docs</a></li>
     
      </ul>
      <!--<button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>-->
    </div>
