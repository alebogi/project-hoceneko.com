<?php namespace App\Controllers;

/**
 * Gost - kontroler koji pozivaju osobe koje nisu ulogovane
 * 
 * @version 1.0
 * 
 * @author Ognjen Subaric 0425/17
 */

use App\Models\KorisnikModel;

class Gost extends BaseController {
    
    /**
     * Modularna funckija na osnovu koje se bira centralni view
     * 
     * @param string $page stranica na koju se skace
     * @param array $data niz podataka potreban odgovarajucoj stranici
     */
    protected function prikaz($page, $data = NULL) {
        $data['controller']='Gost';
        echo view('sablon/header_gost', $data); //ili header_korisnik
        echo view('sablon/kategorije', $data);
        
        echo view("stranice/$page", $data);
        
        echo view('sablon/reklame');
        echo view('sablon/footer');
    }   
    
    ////////////////////////////////////////////////////////////////////////////
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
