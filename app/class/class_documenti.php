<?php
/* 
 * CLASSE PER STATISTICHWE DOCUMENTI
 */

require_once  'class_connection.php' ;
// require_once  'class_session.php';

abstract class Documenti  {
  
}


class Documento extends Documenti{
    
    private $db;
    
public function __construct(){
		// Instantiate new Database object
		$this->db = new Database;
  }              
     

public function vedi_profilo($id_utente){
            
                 $this->db->query("SELECT utente.*, ruolo.descrizione FROM utente
                                INNER JOIN ruolo ON utente.ruolo_id=ruolo.id
                                where utente.id = :id
                                 AND attivo = 1
                                 AND data_scadenza > now();");
            
            // Bind dei parametri
            $this->db->bind(':id', $id_utente);
         
            
            if($this->db->execute())
		{
			if($this->db->rowCount() > 0)
			{
                            $rows = $this->db->single();
                            return  $rows;
				
			}
		} else {
                     // Handle errors
                    return $this->db->getError(); 
                }
       
} // END METHOD ******************************************************


public function conta_documenti( $id_utente = null ){
            
                 $this->db->query("SELECT COUNT(*) as n_documenti 
                                            FROM documenti WHERE documenti.utente_id IN  ( SELECT id_cts_sede FROM associazioni_cts, documenti WHERE associazioni_cts.id_cts_admin = :id )
                                            or documenti.utente_id = :id;");
                                
            
            // Bind dei parametri
             $this->db->bind(':id', $id_utente);
         
            
            if($this->db->execute())
		{
			if($this->db->rowCount() > 0)
			{
                            $rows = $this->db->single();
                            return  $rows;
				
			}
		} else {
                     // Handle errors
                    return $this->db->getError(); 
                }
       
} // END METHOD ******************************************************

public function statistiche_documenti( $id_utente = null) {
            
    if ($id_utente > 0) {
        
    
                 $this->db->query("SELECT documenti.data_ora_caricamento, documenti.nome_file, documenti.oggetto, utente.denominazione
                                    FROM documenti
                                    LEFT JOIN utente ON documenti.utente_id = utente.id
                                    WHERE documenti.utente_id IN  ( SELECT id_cts_sede FROM associazioni_cts, documenti WHERE associazioni_cts.id_cts_admin = :id )
                                    or documenti.utente_id = :id 
                                    
                                    
                            ORDER BY  date(data_ora_caricamento) desc
                            LIMIT 10 ;");
            
                // Bind dei parametri
                $this->db->bind(':id', $id_utente);
    } 
    
            
            if($this->db->execute())
            {
                if($this->db->rowCount() > 0)
                {
                                $rows = $this->db->resultset();
                                return  $rows;
                    
                }
            } else {
                        // Handle errors
                        return $this->db->getError(); 
                    }
       
} // END METHOD ******************************************************

    
} // END CLASS ******************************************    