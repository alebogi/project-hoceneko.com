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
}