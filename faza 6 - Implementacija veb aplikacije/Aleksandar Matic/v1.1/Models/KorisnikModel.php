<?php namespace App\Models;

use CodeIgniter\Model;
/*
 * Klasa KorisnikModel - sluzi za dohvatanje podataka iz tabele Korisnik iz baze podataka
 * 
 * 
 * 
 */
class KorisnikModel extends Model
{
        protected $table      = 'korisnik';
        protected $primaryKey = 'idKor';
        protected $returnType = 'object';
        protected $allowedFields = ['korisnicko_ime', 'lozinka', 'ime', 'prezime', 'pol', 'e_mail' , 'datum_rodjenja', 'tip' , 'ocena' , 'opis', 'profilna_slika'];
        
        
        public function dohvatiId($korisnik){
            $result = $this->where('korisnicko_ime',$korisnik)->first();
            return $result->idKor;
        }
}