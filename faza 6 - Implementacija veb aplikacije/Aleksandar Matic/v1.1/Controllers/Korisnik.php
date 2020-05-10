<?php namespace App\Controllers;

use App\Models\ObjavaModel;
use App\Models\KorisnikModel;

class Korisnik extends BaseController
{
    protected function prikaz($page, $data) {
        /*  Sluzi dok se ne implementira logovanje korisnika
         */
        $korisnikModel = new KorisnikModel();
        $this->session->set('korisnik','aleksandar');
        $this->session->set('korisnik_id' , $korisnikModel->dohvatiId($this->session->get('korisnik')));
        $data['korisnik']= $korisnikModel->find($this->session->get('korisnik_id'));
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
            'broj_potrebnih_clanova' => 'required|is_natural',
            'datum' => 'required',
            'vreme' => 'required',
            'mesto' => 'required|max_length[20]',
            'opis' => 'required|min_length[5]|max_length[999]'
        ])){
            return $this->prikaz('postavljanjeObjave', ['errors'=>$this->validator->listErrors()]);
        }
        $now = time();
        $submitDate = strtotime($this->request->getVar('datum'));
        if($submitDate < $now){
            return $this->prikaz('postavljanjeObjave', ['errors'=>'Datum koji ste izabrali je vec prosao!']);
        }
        
        if($this->request->getVar('tip') == TRUE) {
           $tip = 'premium';
       }
       else $tip = 'obicna';
       $korisnik_id = $this->session->get('korisnik_id');
       $objava = [
              'naziv' => $this->request->getVar('naziv'),
               'kategorija' => $this->request->getVar('kategorija'),
               'br_potrebnih_clanova' => $this->request->getVar('broj_potrebnih_clanova'),
               'br_prijavljenih_clanova' => 1,
               'datum' => $this->request->getVar('datum'),
               'vreme' => $this->request->getVar('vreme'),
               'mesto' => $this->request->getVar('mesto'),
               'opis' => $this->request->getVar('opis'),
               'tip' => $tip,
               'idKor' => $korisnik_id
        ];
       $objavaModel = new ObjavaModel();
       $objavaModel->save($objava);
       
       $this->db->table('prijavljen')->insert([
                'idKor' => $korisnik_id,
                'idObj' => $objavaModel->getInsertID(),
               ]);
       return redirect()->to(site_url("Korisnik/index"));
    }
}
