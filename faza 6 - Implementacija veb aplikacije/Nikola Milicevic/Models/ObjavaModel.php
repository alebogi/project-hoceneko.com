<?php namespace App\Models;

use CodeIgniter\Model;
/*
 * Klasa ObjavaModel - klasa modela koji sluzi za dohvatanje podataka iz tabele Objava u bazi podataka
 * 
 * 
 */
class ObjavaModel extends Model
{
        protected $table      = 'objava';
        protected $primaryKey = 'idObj';
        protected $returnType = 'object';
        protected $allowedFields = ['naziv', 'kategorija', 'broj_potrebnih_clanova', 'broj_prijavljenih_clanova', 'datum', 'vreme' , 'mesto', 'opis' , 'tip' , 'idKor'];
        
        /*
         *  Funkcija dohvatiPoFilterima - sluzi za dohvatanje podataka iz tabele Objava na osnovu prosledjenih filtera
         * @param Date $datum_od
         * @param Date $datum_do
         * @param String $mesto
         * @param Time $vreme_od
         * @param Time $vreme_do
         * 
         * @var QueryBuilder $upit
         * 
         * return String[] 
         * 
         * @autor Aleksandar Matic
         * 
         */
        public function dohvatiPoFilterima($datum_od,$datum_do,$mesto,$vreme_od,$vreme_do){
            $upit;
            if(!empty($datum_od)){
               $upit = $this->where('datum >=',$datum_od);
            }
            if(!empty($datum_do)){
                if(!empty($upit)){
                $upit = $upit->where('datum <=',$datum_do);
                }
                else $upit = $this->where('datum <', $datum_do);
            }
            if(!empty($mesto)){
                if(!empty($upit)){
                $upit = $upit->like('mesto',$mesto);
                }
                else $upit = $this->like('mesto',$mesto);
            }
            if(!empty($vreme_od)){
               if(!empty($upit)){
                $upit = $upit->where('vreme >=',$vreme_od);
                }
                else $upit = $this->where('vreme >=', $vreme_od);
            }
            if(!empty($vreme_do)){
                if(!empty($upit)){
                $upit = $upit->where('vreme <=',$vreme_do);
                }
                else $upit = $this->where('vreme <=', $vreme_do);
            }
            if(!empty($upit)){
                return $upit->paginate(10);
            }
            else return $this->paginate(10);
        }
        
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
}