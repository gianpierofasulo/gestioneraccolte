<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once $config['CONFIG_PATH'] . 'common.php';
require_once $config['XCRUD_PATH'] . 'xcrud.php';

#require_once '../xcrud/xcrud.php';
    	
            $xcrud = Xcrud::get_instance();
            $xcrud->table('utente');
            
//            $xcrud->unset_add();
//            $xcrud->unset_edit();
                $xcrud->unset_remove();
                
                $xcrud->table_name('Gestione password - Accessi');
                $xcrud->fields('comuni_basilicata_id, indirizzo, responsabile, email, data_scadenza, attivo,ruolo_id,codice_univoco', true);
                $xcrud->columns('indirizzo', true, true, true);

                $xcrud->relation('comuni_basilicata_id','comuni_basilicata','id',array('comune','provincia') );
                $xcrud->relation('ruolo_id','ruolo','id',array('descrizione'));
             
                $xcrud->change_type('attivo', 'select', '', array('values' => 
                                        array(0 => 'NO', 1 => 'SI'))
                                );

                                $xcrud->readonly('denominazione');                                
             
            $xcrud->label('comuni_basilicata_id','COMUNE');
            $xcrud->before_update('cripta_password');
            
             
//             $xcrud->highlight('validata','=','1','#11d911');