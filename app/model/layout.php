<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');


if ( !isset($_SESSION['utente_ruolo']) || $_SESSION['utente_attivo'] == 0 ) {
    header('Location: index.php');
    exit();
}

require_once $config['CLASS_PATH'] . 'class_utente.php';
require_once $config['CLASS_PATH'] . 'class_documenti.php';

            $utenti = new Utente;
            $documenti = new Documento;
            
            // dati accesso dashboard ADMIN
            $elenco_login = $utenti->statistiche_login();

            // dati accesso dashboard ALTRI LIVELLI UTENTI
            $elenco_login_utente = $utenti->statistiche_login( $_SESSION['utente_id']);
            
            // Numero utenti
            $numero_utenti = $utenti->conta_utenti();

            //Numero documenti totali in piattaforma 
            $numero_documenti = $documenti->conta_documenti( $_SESSION['utente_id'] );

            //Ultimi 10 documenti caricati
            $ultimi_10_documenti = $documenti->statistiche_documenti( $_SESSION['utente_id'] );

            
  