<?php namespace App\Models;

use CodeIgniter\Model;

/**
 * KorisnikModel - klasa koja predstavlja tabelu korisnik
 * 
 * @version 1.0
 * 
 * @author Ognjen Subaric 0425/17
 */
class KorisnikModel extends Model
{
    protected $table        = 'korisnik'  ;
    protected $primaryKey   = 'idKor'   ;
    protected $returnType   = 'object'  ;
    
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
}