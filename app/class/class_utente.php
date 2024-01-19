<?php
/* 
 * CLASSE DI CONTOLLO LOGIN
 */

require_once  'class_connection.php' ;
// require_once  'class_session.php';

abstract class Utenti  {
  
}


class Utente extends Utenti{
    
    private $db;
    
public function __construct(){
		// Instantiate new Database object
		$this->db = new Database;
  }              
     
public function registra_sessione( $utente_id, $utente_nome, $utente_email,
        $utente_data_scadenza, $utente_attivo, $utente_ruolo, $utente_id_ruolo){
            
                    
                    if(session_start() ) {
                        
                        $_SESSION['utente_id'] = $utente_id;
                        $_SESSION['denominazione'] = $utente_nome;
                       
                        $_SESSION['utente_email'] = $utente_email;
                        $_SESSION['utente_data_scadenza'] = $utente_data_scadenza;
                        $_SESSION['utente_attivo'] = $utente_attivo;
                        $_SESSION['utente_ruolo'] = $utente_ruolo;
                        $_SESSION['utente_id_ruolo'] = $utente_id_ruolo;

                        return true;
                    }
                    return false;
       
} // END METHOD ******************************************************

public function distruggi_sessione(){
            
                 session_destroy();
       
} // END METHOD ******************************************************

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

public function modifica_profilo($id_utente, $utente_nome,  $utente_email, $utente_password = null){
    
                if ( $utente_password == null) {
                        $this->db->query("UPDATE utente SET
                                        denominazione = :utente_nome,
                                        email = :utente_email
                                        WHERE id = :id;");
                 } else { 
                     $this->db->query("UPDATE utente SET
                                        denominazione = :utente_nome,
                                        email = :utente_email,
                                        password = :utente_password
                                        WHERE id = :id;");
                     $this->db->bind(':utente_password', $utente_password);
                 }
            // Bind dei parametri
            $this->db->bind(':id', $id_utente);
            $this->db->bind(':utente_nome', $utente_nome);
            
            $this->db->bind(':utente_email', $utente_email);
           
         
            
            if($this->db->execute())
		{
		   return true;
		} else {
                     // Handle errors
                    return $this->db->getError(); 
                }
       
} // END METHOD ******************************************************

public function conta_utenti(){
            
                 $this->db->query("SELECT COUNT(*) as n_utenti FROM utente;");
                                
            
            // Bind dei parametri
            // $this->db->bind(':id', $id_utente);
         
            
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

public function statistiche_login( $id_utente = null) {
            
    if ($id_utente > 0) {
        
    
                 $this->db->query("SELECT utente.denominazione as utente, utente.data_scadenza,
                            COUNT(utente_login.id) AS numero_login,
                            date(utente_login.data_accesso) AS primo_login, 
                            date(utente_login.data_accesso) AS ultimo_login,                           
                            utente_login.data_accesso AS giorni_da_utlimo_login
                            FROM utente, utente_login
                            WHERE utente.id = utente_login.utente_id
                            AND utente.id = :id
                            group BY  date(utente_login.data_accesso) 
                            ORDER BY  date(utente_login.data_accesso) desc
                            LIMIT 6 ;");
            
                // Bind dei parametri
                $this->db->bind(':id', $id_utente);
    } else {


                $this->db->query("SELECT utente.denominazione as utente, utente.data_scadenza,
                COUNT(utente_login.id) AS numero_login,
                MIN( date(utente_login.data_accesso) ) AS primo_login, 
                MAX( date(utente_login.data_accesso) ) AS ultimo_login,                           
                DATEDIFF( NOW() , MAX( utente_login.data_accesso )  ) AS giorni_da_utlimo_login
                FROM utente, utente_login
                WHERE utente.id = utente_login.utente_id
                GROUP BY utente_login.utente_id
                ORDER BY MAX( date(utente_login.data_accesso) ) desc 
                LIMIT 6 ;");
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