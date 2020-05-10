<?php namespace App\Models;

use CodeIgniter\Model;

/**
 * ObjavaModel - klasa koja predstavlja tabelu objava
 * 
 * @version 1.0
 * 
 * @author Ognjen Subaric 0425/17
 */
class ObjavaModel extends Model
{
    protected $table        = 'objava'  ;
    protected $primaryKey   = 'idObj'   ;
    protected $returnType   = 'object'  ;
    
    protected $allowedFields = ['naziv', 'kategorija', 'br_potrebnih_clanova', 'br_prijavljenih_clanova', 'datum', 'vreme' , 'mesto', 'opis' , 'tip' , 'idKor'];
    /**
     * Funckija koja pretrazuje bazu da bi nasla objave koje odgovaraju kriterijumu
     * 
     * @param string $kategorija kategorija po kojoj se vrsi pretraga
     * @return resoult
     * 
     * @author Ognjen Subaric 0425/17
     */
    public function pretraga($kategorija) {
        if($kategorija == 'sve'){
            return $this->where('datum >=', date("Y-m-d"))->orderBy('tip', 'DESC')->orderBy('datum', 'ASC')->findAll();
        }
        return $this->like('kategorija', $kategorija)->where('datum >=', date("Y-m-d"))->orderBy('tip', 'DESC')->orderBy('datum', 'ASC')->findAll();      
    }
    
    
    /**
     * Pomocna funckija koja pomaze pri upitu koji podrazumeva spajanje dve tabele
     * 
     * @param string $order kriterijum sortiranja
     * @param string $kategorija kategorija po kojoj se vrsi pretraga
     * @return resoult 
     * 
     * @author Ognjen Subaric 0425/17
     */
    private function sortOceneKorisnika($order, $kategorija){
        $db      = \Config\Database::connect();
        $builder = $db->table('objava');
        $builder->select('*');
        $builder->join('korisnik', 'korisnik.idKor = objava.idKor');
        if($kategorija != "sve"){
            $builder->like("kategorija", $kategorija);
        }
        $builder->where('datum >=', date("Y-m-d"));
        $builder->orderBy("objava.tip", "DESC");
        $builder->orderBy("ocena", $order);
        $query = $builder->get();
        $result = $query->getResult();
//        forEach($result as $res){
//            echo $res->naziv . "<br>";
//            echo $res->kategorija . "<br>";
//            echo $res->korisnicko_ime . "<br>";
//            echo $res->ime . "<br>";
//            echo $res->ocena . "<br>";
//            echo "------------------<br>";
//        }
        return $result;
    }
    
    /**
     * Funckija koja pretrazuje bazu da bi nasla objave koje odgovaraju kriterijumima
     * 
     * @param string $kategorija
     * @param string $order kriterijum sortiranja
     * @return resoult
     * 
     * @author Ognjen Subaric 0425/17
     */
    public function pretragaSort($kriterijum, $order, $kategorija){
        if($kriterijum == "ocena")
            return $this->sortOceneKorisnika($order, $kategorija);
        if($kategorija == 'sve')
            return $this->where('datum >=', date("Y-m-d"))->orderBy('tip', 'DESC')->orderBy($kriterijum, $order)->findAll();
        return $this->like('kategorija', $kategorija)->where('datum >=', date("Y-m-d"))->orderBy('tip', 'DESC')->orderBy($kriterijum, $order)->findAll();
    }
    
    /**
     * Metoda za dohvatanje broja potrebnih ljudi
     * 
     * @param int $idObj primarni kljuc tabele objava
     * @return int broja potrebnih ljudi
     * 
     * @author Ognjen Subaric 0425/17
     */
    public function dohvatiBrPotrebnihClanova($idObj){
        return $this->find($idObj)->br_potrebnih_clanova;
    }
    
    /**
     * Metoda za dohvatanje broja prijavljenih ljudi
     * 
     * @param int $idObj primarni kljuc tabele objava
     * @return int broja prijavljenih ljudi
     * 
     * @author Ognjen Subaric 0425/17
     */
    public function dohvatiBrPrijavljenihClanova($idObj){
        return $this->find($idObj)->br_prijavljenih_clanova;
    }
    
    /**
     * Metoda koja povecava broj prijavljenih ljudi
     * 
     * @param int $idObj primarni kljuc tabele objava
     * 
     * @author Ognjen Subaric 0425/17
     */
    public function povecajBrPrijavljenih($idObj){
        $stariBrojPrijavljenih = $this->find($idObj)->br_prijavljenih_clanova;
        $data = [
        'br_prijavljenih_clanova'    => $stariBrojPrijavljenih + 1
        ];
        $this->update($idObj, $data);
    }
}