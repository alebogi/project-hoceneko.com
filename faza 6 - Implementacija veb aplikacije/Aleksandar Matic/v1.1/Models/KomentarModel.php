<?php namespace App\Models;

use CodeIgniter\Model;
/*
 * Klasa KorisnikModel - sluzi za dohvatanje podataka iz tabele Korisnik iz baze podataka
 * 
 * 
 * 
 */
class KomentarModel extends Model
{
        protected $table      = 'komentar';
        protected $primaryKey = 'idKom';
        protected $returnType = 'object';
        protected $allowedFields = ['sadrzaj', 'idObj', 'idKor'];
        
}