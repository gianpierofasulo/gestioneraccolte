<?php
/* 
 * CLASSE DI CONTOLLO LOGIN
 */

include  'class_connection.php' ;

abstract class Accessi  {
  
}


class Login extends Accessi{
    
    private $db;
    
public function __construct(){
		// Instantiate new Database object
		$this->db = new Database;
  }              
     
public function controllo( $email, $password){
                
            
             $this->db->query("SELECT utente.*, ruolo.descrizione FROM utente
                                INNER JOIN ruolo ON utente.ruolo_id=ruolo.id
                                where email = :email and password = :password
                                 AND attivo = 1
                                 AND data_scadenza > now();");
            
            // Bind dei parametri
            $this->db->bind(':email', $email);
            $this->db->bind(':password', hash('sha256', $password));
            

            
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
            
            

       
} // END METHOD controllo ******************************************************
    
public function registra_secret( $client_ip, $utente_id, $secret){
                

               $this->db->query("INSERT INTO utente_login
                            ( id, utente_id, ip, secret )
                                        VALUES ( null,
                                                :utente_id,
                                                :client_ip,
                                                :secret ) ");
            
            // Bind dei parametri
            $this->db->bind(':client_ip', $client_ip);
            $this->db->bind(':secret', $secret);
            $this->db->bind(':utente_id', $utente_id);
             

            
             if( $this->db->execute())
		{
		
                    return true;
		
		} else {
                     // Handle errors
                    return $this->db->getError(); 
                }
            

} // END METHOD registra_secret ******************************************************
 
public function controlla_secret( $client_ip, $utente_id){
                
            
             $this->db->query("SELECT secret, id FROM utente_login WHERE utente_login.utente_id = :utente_id
                                            AND utente_login.ip = :client_ip
                                            AND validata = 0
                                            ORDER BY id DESC LIMIT 1;");
            
            // Bind dei parametri
            $this->db->bind(':client_ip', $client_ip);
            $this->db->bind(':utente_id', $utente_id);
            
                
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
    
       
} // END METHOD controllo ******************************************************

public function valida_secret($id_record){
                
            
            $this->db->query("UPDATE utente_login SET validata = 1 WHERE id = :id_record;");
            
            // Bind dei parametri
            $this->db->bind(':id_record', $id_record);
            
 
                if( $this->db->execute())
		{
		
                    return true;
		
		} else {
                     // Handle errors
                    return $this->db->getError(); 
                }
    
       
} // END METHOD valida_secret ******************************************************

public function reset_password( $email){
                
            
             $this->db->query("SELECT utente.email FROM utente
                         
                                where email = :email
                                 AND attivo = 1
                                 AND data_scadenza > now();");
            
            // Bind dei parametri
            $this->db->bind(':email', $email);
             
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
            
            

       
} // END METHOD controllo ******************************************************
    
} // END CLASS ******************************************    