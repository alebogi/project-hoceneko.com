<?php namespace App\Controllers;

use App\Models\ObjavaModel;
use App\Models\KorisnikModel;

class Korisnik extends BaseController
{
    protected function prikaz($page, $data) {
        $data['korisnik']= $this->session->get('korisnik');
        $data['controller']='Korisnik';
        
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
    
    
    
    /* Funkcija za odjavu ulogovanog korisnika
     * 
     * 
     * @author Nikola Milicevic 0387/17
     */
    
    
    public function odjava(){
        $this->session->destroy();
        return redirect()->to(site_url('Gost'));
    }
}
