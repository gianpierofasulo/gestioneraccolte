<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once $config['CONFIG_PATH'] . 'common.php';
require_once $config['XCRUD_PATH'] . 'xcrud.php';

#require_once '../xcrud/xcrud.php';
    	
            $xcrud = Xcrud::get_instance();
            $xcrud->table('associazioni_cts');
            
//            $xcrud->unset_add();
//            $xcrud->unset_edit();
            $xcrud->unset_remove();
            
            $xcrud->table_name('Associa centro ADMIN - SEDI PERIFERICHE');
            
            $xcrud->relation('id_cts_admin','utente','id',array('denominazione'), array('ruolo_id =' => 2) );
            $xcrud->relation('id_cts_sede','utente','id',array('denominazione'), array('ruolo_id =' => 3) );

         /*     $xcrud->relation('comuni_basilicata_id','comuni_basilicata','id',array('comune'));
             $xcrud->relation('ruolo_id','ruolo','id',array('descrizione'));
             
             $xcrud->change_type('attivo', 'select', '', array('values' => 
                                        array(0 => 'NO', 1 => 'SI'))
                                ); */
             
                                $xcrud->before_insert('controlla_duplicati');
                                

             $xcrud->label('id_cts_admin','CTS principale');
             $xcrud->label('id_cts_sede','CTS sede periferica');
//             $xcrud->highlight('validata','=','1','#11d911');