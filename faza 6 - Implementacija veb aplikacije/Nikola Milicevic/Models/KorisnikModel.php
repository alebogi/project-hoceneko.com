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
        

        
        /**
     * Funkcija za dohvatanje korisnika sa zadatim id-jem iz tabele
     * 
     * @param int $idKor
     * @return resoult
     * 
     * @author Ognjen Subaric 0425/17
     */
    public function dohvatiKorisnika($idKor) {
        return $this->find($idKor);
    }
    /**
     * Funkcija za dohvatanje korisnickog imena sa zadatim id-jem iz tabele
     * 
     * @param int $idKor
     * @return string
     * 
     * @author Ognjen Subaric 0425/17
     */
    public function dohvatiKorisnickoIme($idKor){
        return $this->find($idKor)->korisnicko_ime;
    }
    
    /**
     * Funkcija za dohvatanje ocene korisnika sa zadatim id-jem iz tabele
     * 
     * @param int $idKor
     * @return double
     * 
     * @author Ognjen Subaric 0425/17
     */
    public function dohvatiOcenu($idKor){
        return $this->find($idKor)->ocena;
    }
    
    public function dohvatiId($korisnik){
            $result = $this->where('korisnicko_ime',$korisnik)->first();
            return $result->idKor;
        }
}