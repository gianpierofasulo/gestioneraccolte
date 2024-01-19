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

            $xcrud->where(  'CONCAT(",", utente_id_destinatario, ",") LIKE "%,'.$_SESSION['utente_id'].',%" ' );
          
            //  WHERE CONCAT(',', utente_id_destinatario, ',') LIKE '%,66,%';

            // $xcrud->query('SELECT * FROM documenti WHERE FIND_IN_SET('.$_SESSION['utente_id'].' , utente_id_destinatario)');

            // passo id utente in automatico
            $xcrud->pass_var('utente_id', $_SESSION['utente_id'] );

            $date = new DateTime("now", new DateTimeZone('Europe/Rome') );
            $data_caricamento = $date->format('Y-m-d H:i:s');
            $xcrud->pass_var('data_ora_caricamento', $data_caricamento );

            if ( $_SESSION['utente_id_ruolo'] == 1) {
                // super ADMIN
                $xcrud->fields('data_ora_caricamento', true);
                $xcrud->columns('data_ora_caricamento', true); 
                $xcrud->change_type('pubblico', 'select', '', array('values' => 
                                        array(0 => 'NO', 1 => 'SI'))
                                );
                
            } else {
                // non può modificare o cancellare se non è il proprietario
                $xcrud->unset_remove(true, 'utente_id','!=',$_SESSION['utente_id']);
                $xcrud->unset_edit(true, 'utente_id','!=',$_SESSION['utente_id']);

                // non può vedere se è pubblico
                $xcrud->fields('pubblico, utente_id, data_ora_caricamento', true);
                $xcrud->columns('pubblico, utente_id, descrizione, nome_file', true, true, true);

                // $xcrud->before_update('cripta_password');
               
            }
            // relazione con campo multi select tra le virgolette 2 parmetri non obbligatori il primo è la where es. array('published' => 1) il secondo order by
            $xcrud->relation('utente_id_destinatario','utente','id',array('denominazione'),'','',array('multi' => true) );

            $xcrud->relation('utente_id','utente','id',array('denominazione'));

            $xcrud->change_type('nome_file', 'file', '', array('not_rename'=>false));
          //  $xcrud->readonly('data_ora_lettura,utente_id');
            
             // $xcrud->relation('comuni_basilicata_id','utente','id',array('cognome','nome'),array('tipo_utente' => 1));
           
           /*   $xcrud->change_type('attivo', 'select', '', array('values' => 
                                        array(0 => 'NO', 1 => 'SI'))
                                ); */
             
             $xcrud->label('utente_id','UTENTE');
             $xcrud->label('data_ora_caricamento','Caricato il');
            
             
//             $xcrud->highlight('validata','=','1','#11d911');

            $xcrud->before_view('aggiorna_lettura');