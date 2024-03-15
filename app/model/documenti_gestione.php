<?php
error_reporting(E_ALL ^ E_DEPRECATED);
ini_set('display_errors', '1');
require_once $config['CONFIG_PATH'] . 'common.php';
require_once $config['XCRUD_PATH'] . 'xcrud.php';

#require_once '../xcrud/xcrud.php';
    	
            $xcrud = Xcrud::get_instance();
            $xcrud->table('documenti');
            
//            $xcrud->unset_add();
//            $xcrud->unset_edit();
//            $xcrud->unset_remove();
            // $xcrud->unset_remove(true, 'preventivi_accettazione','!=','0'); // esempio bottone con condizione

            
            
            $xcrud->table_name('Gestione Documenti');

         

            // passo id utente in automatico
            $xcrud->pass_var('utente_id', $_SESSION['utente_id'] );

            $date = new DateTime("now", new DateTimeZone('Europe/Rome') );
            $data_caricamento = $date->format('Y-m-d H:i:s');
            $xcrud->pass_var('data_ora_caricamento', $data_caricamento );

            if ( $_SESSION['utente_id_ruolo'] == 1) {
                // super ADMIN
              
            
                $xcrud->fields('utente_id, data_ora_caricamento, pubblico, utente_id_destinatario', true);
                $xcrud->columns('pubblico, utente_id_destinatario, descrizione', true);
            }  else if ( $_SESSION['utente_id_ruolo'] == 2 || $_SESSION['utente_id_ruolo'] == 6) {
                // CTS - ADMIN
                $xcrud->unset_remove(true, 'utente_id','!=',$_SESSION['utente_id']);
                $xcrud->unset_edit(true, 'utente_id','!=',$_SESSION['utente_id']);
                // $xcrud->where('utente_id in (SELECT id_cts_sede FROM associazioni_cts WHERE associazioni_cts.id_cts_admin = '.$_SESSION['utente_id'].' ) or documenti.utente_id = '.$_SESSION['utente_id'] );
                $xcrud->where('utente_id = '.$_SESSION['utente_id'].' or documenti.utente_id_destinatario = '.$_SESSION['utente_id'] );
                $xcrud->fields('utente_id, data_ora_caricamento, pubblico, utente_id_destinatario', true);
                $xcrud->columns('pubblico, utente_id_destinatario', true);
            }
            else {
              // CTS SEDE
                $xcrud->where('utente_id',  $_SESSION['utente_id'] );
                // non può modificare o cancellare se non è il proprietario
                $xcrud->unset_remove(true, 'utente_id','!=',$_SESSION['utente_id']);
                $xcrud->unset_edit(true, 'utente_id','!=',$_SESSION['utente_id']);

                // non può vedere se è pubblico
                $xcrud->fields('data_ora_caricamento, pubblico, utente_id', true);
                $xcrud->columns('pubblico, utente_id, descrizione', true, true, true);

                // $xcrud->before_update('cripta_password');
               
            }
            // relazione con campo multi select tra le virgolette 2 parmetri non obbligatori il primo è la where es. array('published' => 1) il secondo order by
            // $xcrud->relation('utente_id_destinatario','utente','id',array('denominazione'),'','',array('multi' => true) );

            $xcrud->relation('utente_id','utente','id',array('denominazione'));

            $xcrud->change_type('nome_file', 'file', '', array('not_rename'=>false));
            $xcrud->readonly('utente_id');
            if ($_SESSION['utente_id_ruolo'] == 3) {
                $xcrud->relation('utente_id_destinatario','utente','id',array('denominazione'),array('ruolo_id' => 6));
            }
            // IDC sarebbe id del centro trasfusionale
            if ( isset($_GET['idc']) ) {
                $centro = $_GET['idc'];
                
            } else {
                $centro = 0;
            }
            $xcrud->change_type('utente_id_destinatario', 'select', $centro
                                );
             
             $xcrud->label('utente_id','UTENTE');
             $xcrud->label('utente_id_destinatario','Destinatario');
             $xcrud->label('data_ora_caricamento','Caricato il');
            
             
//             $xcrud->highlight('validata','=','1','#11d911');

       //     $xcrud->before_view('aggiorna_lettura');