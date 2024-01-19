<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once $config['CONFIG_PATH'] . 'common.php';
require_once $config['XCRUD_PATH'] . 'xcrud.php';

#require_once '../xcrud/xcrud.php';
    	
            $xcrud = Xcrud::get_instance();
            $xcrud->table('utente_login');
            
            $xcrud->unset_add();
            $xcrud->unset_edit();
            $xcrud->unset_remove();
            
            $xcrud->table_name('Log accessi alla piattaforma');
            
            $xcrud->relation('utente_id','utente','id',array('denominazione'));
         /*     $xcrud->relation('comuni_basilicata_id','comuni_basilicata','id',array('comune'));
             $xcrud->relation('ruolo_id','ruolo','id',array('descrizione'));
             
             $xcrud->change_type('attivo', 'select', '', array('values' => 
                                        array(0 => 'NO', 1 => 'SI'))
                                ); */
            $xcrud->columns('secret,validata', true);
             $xcrud->label('utente_id','Denominazione');

             $xcrud->order_by('data_accesso','desc');
             
//             $xcrud->highlight('validata','=','1','#11d911');