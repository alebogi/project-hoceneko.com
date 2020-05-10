<?php namespace App\Models;

use CodeIgniter\Model;
/**
 * Klasa ZahtevModel - sluzi za dohvatanje podataka iz tabele Zahtev iz baze podataka
 * 
 * @author Aleksandra Bogicevic 0390/17
 * 
 */
class ZahtevModel extends Model{
        protected $table      = 'zahtev';
        protected $primaryKey = 'idZah';
        protected $returnType = 'object';
        protected $allowedFields = ['tema', 'opis', 'status', 'idKor'];
        

}