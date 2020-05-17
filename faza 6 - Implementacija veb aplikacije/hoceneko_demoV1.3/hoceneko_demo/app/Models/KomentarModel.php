<?php namespace App\Models;

use CodeIgniter\Model;

/**
 * ObjavaModel - klasa koja predstavlja tabelu objava
 * 
 * @version 1.0
 * 
 * @author Ognjen Subaric 0425/17
 */
class KomentarModel extends Model
{
    protected $table        = 'komentar'  ;
    protected $primaryKey   = 'idKom'   ;
    protected $returnType   = 'object'  ;
    
    /**
     * Metoda koja dohvata komentar objave
     * 
     * @param int $idObj primarni kljuc tabele objava
     * @return resoult rezultat query-ja
     * 
     * @author Ognjen Subaric 0425/17
     */
    public function dohvatiKomentare($idObj){
        return $this->where('idObj', $idObj)->orderBy('idKom', 'ASC')->findAll();
    }
    
    /**
     * Metoda koja ubacuje komentar
     * 
     * @param string $sadrzaj
     * @param int $idKor primarni kljuc tabele korisnik
     * @param int $idObj primarni kljuc tabele objava
     * 
     * @author Ognjen Subaric 0425/17
     */
    public function ubaciKomentar($sadrzaj, $idKor, $idObj){
        $db      = \Config\Database::connect();
        $builder = $db->table('komentar');
        $data = [
        'sadrzaj' => $sadrzaj,
        'idObj'  => $idObj,
        'idKor'  => $idKor
        ];
        $builder->insert($data);
    }
}