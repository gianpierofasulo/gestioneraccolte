<?php
error_reporting(E_ALL ^ E_DEPRECATED);
ini_set('display_errors', '1');
require_once $config['CONFIG_PATH'] . 'common.php';
require_once $config['XCRUD_PATH'] . 'xcrud.php';

#require_once '../xcrud/xcrud.php';
    	
            $xcrud = Xcrud::get_instance();
         
            
//            $xcrud->unset_add();
//            $xcrud->unset_edit();
//            $xcrud->unset_remove();
            // $xcrud->unset_remove(true, 'preventivi_accettazione','!=','0'); // esempio bottone con condizione

            
          
            if ( $_SESSION['utente_id_ruolo'] == 1) {
                // super ADMIN
                $xcrud->query(' SELECT *  FROM documenti, utente
                WHERE documenti.utente_id IN  ( SELECT id_cts_sede FROM associazioni_cts WHERE associazioni_cts.id_cts_admin = '.$_SESSION['utente_id'].' )
                AND documenti.utente_id = utente.id ');
                
               // $xcrud->query(' SELECT * FROM documenti WHERE documenti.utente_id IN  ( SELECT id_cts_sede FROM associazioni_cts WHERE associazioni_cts.id_cts_admin = '.$_SESSION['utente_id'].' ) ');
            }  else if ( $_SESSION['utente_id_ruolo'] == 2) {
                // CTS - ADMIN
                // $xcrud->query(' SELECT * FROM documenti WHERE documenti.utente_id IN  ( SELECT id_cts_sede FROM associazioni_cts WHERE associazioni_cts.id_cts_admin = '.$_SESSION['utente_id'].' ) ');
                $xcrud->query(' SELECT *  FROM documenti, utente
                WHERE documenti.utente_id IN  ( SELECT id_cts_sede FROM associazioni_cts WHERE associazioni_cts.id_cts_admin = '.$_SESSION['utente_id'].' )
                AND documenti.utente_id = utente.id ');
            }
            else {
              // CTS SEDE - SOLO I PROPRI
              $xcrud->query(' SELECT * FROM documenti WHERE documenti.utente_id  = '.$_SESSION['utente_id']. '') ;
               
            }
           
             
            $xcrud->label('utente_id','UTENTE');
           //  $xcrud->label('utente_id_destinatario','DESTINATARI');
     //        $xcrud->label('data_ora_caricamento','Caricato il');
      