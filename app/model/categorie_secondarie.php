<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once $config['CONFIG_PATH'] . 'common.php';
require_once $config['XCRUD_PATH'] . 'xcrud.php';

#require_once '../xcrud/xcrud.php';
    	
            $xcrud = Xcrud::get_instance();
            $xcrud->table('categorie_secondarie');
            
//            $xcrud->unset_add();
//            $xcrud->unset_edit();
            $xcrud->unset_remove();
            
            $xcrud->table_name('Categorie secondarie files');
            
            $xcrud->relation('categorie_id','categorie','id',array('nome'));
         /*     $xcrud->relation('comuni_basilicata_id','comuni_basilicata','id',array('comune'));
             $xcrud->relation('ruolo_id','ruolo','id',array('descrizione'));
             
             $xcrud->change_type('attivo', 'select', '', array('values' => 
                                        array(0 => 'NO', 1 => 'SI'))
                                ); */
             
             $xcrud->label('categorie_id','Categoria principale');
             $xcrud->label('nome','Nome sottocategoria');
//             $xcrud->highlight('validata','=','1','#11d911');