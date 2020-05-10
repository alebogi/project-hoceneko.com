<?php namespace App\Controllers;
/*
 * Klasa Gost - implementira metode kontrolera koji sluzi za funkcionalnosti Gosta 
 * 
 *  @version 1.0
 */
class Gost extends BaseController
{
    
    /*
     * Funkcija prikaz - sluzi za prikazivanje stranice sa nepromenljivim(header,footer,kategorije,reklame) i promenljivim delovima ( sredisnji deo stranice koji se razlikuje
     * u zavistnosti od trenutne pozicije korisnika na sajtu)
     * 
     * @param string $page String
     * @param string[] $data String[]
     */
    protected function prikaz($page, $data) {
        $data['controller']='Gost';
        echo view('sablon/header_gost');
        echo view('sablon/kategorije');
        
        echo view ("stranice/$page", $data);
        
        echo view('sablon/reklame');
        echo view('sablon/footer');
    }
    
    public function login($puruka=null){
        //TO DO
        //$this->prikaz('login', ['poruka'=>$puruka]);
    }

}
