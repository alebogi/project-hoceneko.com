<?php namespace App\Models;

use CodeIgniter\Model;
/**
 * Klasa ObjavaPrijavaModel - sluzi za dohvatanje podataka iz tabele objava_prijava iz baze podataka
 * 
 * @author Aleksandra Bogicevic 0390/17
 * 
 */
class ObjavaPrijavaModel extends Model{
        protected $table      = 'objava_prijava'; 
        protected $primaryKey = 'idOPri';
        protected $returnType = 'object';
        protected $allowedFields = ['idObj','idKor'];
        

}