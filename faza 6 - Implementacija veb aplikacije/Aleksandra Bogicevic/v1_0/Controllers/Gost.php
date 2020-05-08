<?php namespace App\Controllers;
/*
 * Klasa Gost - implementira metode kontrolera koji sluzi za funkcionalnosti Gosta 
 * 
 *  @version 1.0
 */

use App\Models\KorisnikModel;
use App\Models\ZahtevModel;
use App\Models\ObjavaModel;

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
    
       /* *
     * samo test
     */
    public function login($puruka=null){
        $this->prikaz('login', ['poruka'=>$puruka]);
    }
    
        /* *
     * samo test
     */
    public function loginSubmit(){
        if(!$this->validate(['username'=>'required', 'pass'=>'required'])){
            return $this->prikaz('login', 
                ['errors'=>$this->validator->getErrors()]);
        }
        
        $korisnikModel = new KorisnikModel();
        $korisnik = $korisnikModel->where('korisnicko_ime',$this->request->getVar('username'))->first();
        if($korisnik==null){
            return $this->login("Korisnik ne postoji");
        }
        if($korisnik->lozinka!=$this->request->getVar('pass')){
            return $this->login("Pogresna lozinka!");
        }
        
        
        $this->session->set('korisnik',$korisnik);
        return redirect()->to(site_url('Korisnik'));
    }
}
     

