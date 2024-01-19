<?php
date_default_timezone_set('Europe/Rome');

function controlla_duplicati($postdata, $xcrud)
{
    $id_cts_admin = $postdata->get('id_cts_admin');
    $id_cts_sede = $postdata->get('id_cts_sede');
    $db = Xcrud_db::get_instance();

  //  $conta=  $db->query( ' select * from associazioni_cts where id_cts_admin = ' . $id_cts_admin . ' and id_cts_sede = ' . $id_cts_sede . '' );

    $db = Xcrud_db::get_instance();
    # $db->query("insert into raccordo_commerciali_agenti value ('', $id_commerciale, $id_agente) ");
    $query = " select * from associazioni_cts where id_cts_admin = $id_cts_admin  and id_cts_sede = $id_cts_sede ";
    
	$db->query($query);
        $result = $db->result();
        $count = count($result);
        if ($count > 0) {
        $xcrud->set_exception('id_cts_admin', "ATTENZIONE: abbinamento gia' presente!", 'error');
        }
}



function aggiorna_lettura($postdata, $primary, $xcrud){
    
       $id_utente_lettore = $postdata->get('utente_id');
       $id_record =  $primary;
       $dataOraCorrente = '"'.date('Y-m-d H:i:s').'"';
       $IP = '"'.$_SERVER['REMOTE_ADDR'].'"'; 

	$db = Xcrud_db::get_instance();

    // Aggiorno la tabella dei log con la data di lettura se l'utente non è lo stesso di chi ha caricato il documento

	if ( $_SESSION['utente_id'] != $postdata->get('utente_id')) {
        $query_insert_lettura = " insert into documenti_log_letture (utente_id, documenti_id, data_ora, ip) 
        values ( $id_utente_lettore , $id_record, $dataOraCorrente, $IP )";
              
	
        $db->query( $query_insert_lettura );
       // $result_insert_lettura = $db->result();
    }
       /*  foreach ($result_vedi_canali as $key => $item)
                        {
				 $numero_canali = $item['numero_canali'];
                        }
                        
                if ( $numero_di_canale > $numero_canali) {
                    $xcrud->set_exception('canale','Numero di canale troppo alto.','error');
                }
            } */
};


function cripta_password($postdata, $primary){
    
    $password_criptata = hash('sha256', $postdata->get('password'));
    $postdata->set('password',   $password_criptata );
    
};
