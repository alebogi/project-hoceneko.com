<?php namespace App\Controllers;

use App\Models\ObjavaModel;
use App\Models\KorisnikModel;
use App\Models\ZahtevModel;

class Korisnik extends BaseController
{
    protected function prikaz($page, $data) {
        /*  Sluzi dok se ne implementira logovanje korisnika
         
        $korisnikModel = new KorisnikModel();
        $this->session->set('korisnik','aleksandar');
        $this->session->set('korisnik_id' , $korisnikModel->dohvatiId($this->session->get('korisnik')));
        $data['korisnik']= $korisnikModel->find($this->session->get('korisnik_id'));
        $data['controller']='Korisnik';*/
        
        $data['controller']='Korisnik';
        $data['korisnik']=$this->session->get('korisnik');
        
        echo view('sablon/header_korisnik',$data);
         echo view('sablon/kategorije');
         
        echo view ("stranice/$page", $data);
        
        echo view('sablon/reklame');
        echo view('sablon/footer');
    }
    
    public function postavljanjeObjave(){
        
        $this->prikaz('postavljanjeObjave' , []);
    }
    
    public function postavljanjeObjave_potvrda(){
        if(!$this->validate([
            'naziv' => 'required|min_length[5]|max_length[20]',
            'kategorija' => 'required',
            'broj_potrebnih_clanova' => 'required',
            'datum' => 'required',
            'vreme' => 'required',
            'mesto' => 'required|max_length[20]',
            'opis' => 'required|min_length[5]|max_length[999]'
        ])){
            return $this->prikaz('postavljanjeObjave', ['errors'=>$this->validator->listErrors()]);
        }
        $objavaModel = new ObjavaModel();
       if($this->request->getVar('tip') == TRUE) {
           $tip = 'premium';
       }
       else $tip = 'obicna';
       $korisnik_id = $this->session->get('korisnik_id');
       $objavaModel->save([
               'naziv' => $this->request->getVar('naziv'),
               'kategorija' => $this->request->getVar('kategorija'),
               'br_potrebnih_clanova'=> $this->request->getVar('broj_potrebnih_clanova'),
               'br_prijavljenih_clanova'=> 1,
               'datum' => $this->request->getVar('datum'),
               'vreme' => $this->request->getVar('vreme'),
               'mesto' => $this->request->getVar('mesto'),
               'opis' => $this->request->getVar('opis'),
               'tip' => $tip,
               'idKor' => $korisnik_id
           ]);
       return redirect()->to(site_url("Korisnik/index"));
    }
    
    /**
     * Metoda mojProfil - sluzi za prikazivanje prodila ulogovanog korisnika klikom na odredjeno dugme u meniju
     * 
     * @author Aleksandra Bogicevic 0390/17
     */
    public function mojProfil(){
        $korisnik=$this->session->get('korisnik');
        $this->prikaz('mojProfil', ['korisnik'=>$korisnik]);
    }
    
   
    
    /*
     * Metoda podrskaPotvrda - salje pitanje korisnika
     * 
     * @author Aleksandra Bogicevic 0390/17
     * 
     */
    public function podrskaPotvrda(){
        $korisnik_id = $this->session->get('korisnik_id');

        if(!$this->validate([
            'temaPodrska' => 'required|min_length[3]',
            'porukaPodrska' => 'required|min_length[5]|max_length[999]'
        ])){
            return $this->prikaz('podrska', ['errors'=>$this->validator->listErrors()]);
        }
        $zahtevModel = new ZahtevModel();
       
       $status = 'otvoren';
       $zahtevModel->save([
               'tema' => $this->request->getVar('temaPodrska'),
               'opis' => $this->request->getVar('porukaPodrska'),
               'idKor' => $korisnik_id,
               'status' => $status
           ]);
       
       return redirect()->to(site_url("Korisnik/podrskaPotvrdjeno"));
    }
    
    /*
     * Metoda podrskaPotvrdjeno - uspesno salje pitanje korisnika
     * 
     * @author Aleksandra Bogicevic 0390/17
     * 
     */
    public function podrskaPotvrdjeno(){
        $this->prikaz('podrskaPotvrdjeno' , []);
    }
    
    /* *
     * samo test
     */
    public function logout(){
        $this->session->destroy();
        return redirect()->to(site_url('/'));
        
        
     }
    
}
