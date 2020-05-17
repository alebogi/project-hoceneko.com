<?php namespace App\Models;

use CodeIgniter\Model;
/**
 * Klasa OceniModel - sluzi za dohvatanje podataka iz tabele ocenio iz baze podataka
 * 
 * @author Nikola Milicevic 0387/17
 * 
 */
class OcenioModel extends Model{
        protected $table      = 'ocenio';
        protected $primaryKey = 'id'; //za find() itd se koristi ovo kao pk
        protected $returnType = 'object';
        protected $allowedFields = ['idOcenio','idOcenjen','tip_ocene']; 
        
       

}