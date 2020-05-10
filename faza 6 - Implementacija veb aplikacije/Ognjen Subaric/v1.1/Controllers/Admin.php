<?php namespace App\Controllers;

use App\Models\ObjavaModel;
use App\Models\KorisnikModel;
use App\Models\KomentarModel;

/*
 * Klasa Gost - implementira metode kontrolera koji sluzi za funkcionalnosti Gosta 
 * 
 *  @version 1.0
 */

class Admin extends BaseController
{
    
    /*
     * Funkcija prikaz - sluzi za prikazivanje stranice sa nepromenljivim(header,footer,kategorije,reklame) i promenljivim delovima ( sredisnji deo stranice koji se razlikuje
     * u zavistnosti od trenutne pozicije korisnika na sajtu)
     * 
     * @param string $page String
     * @param string[] $data String[]
     */
    
    protected function prikaz($page, $data) {
        /*  Sluzi dok se ne implementira logovanje korisnika
         */
        $korisnikModel = new KorisnikModel();
        $this->session->set('korisnik','aleksandra');
        $this->session->set('korisnik_id' , $korisnikModel->dohvatiId($this->session->get('korisnik')));
        $data['korisnik']= $korisnikModel->find($this->session->get('korisnik_id'));
        $data['controller']='Admin';
        
        echo view('sablon/header_korisnik',$data);
        echo view('sablon/kategorije');
         
        echo view ("stranice/$page", $data);
        
        echo view('sablon/reklame');
        echo view('sablon/footer');
    }
    
    
    public function ukloniObjavu($idObjave){
        $objavaModel = new ObjavaModel();
        $objavaModel->delete($idObjave);
        
        $komentarModel = new KomentarModel();
        $komentarModel->where('idObj', $idObjave)->delete();   
        
        $this->db->table('prijavljen')->where('idObj',$idObjave)->delete();
        
        return redirect()->to(site_url("Admin/index"));
    }
    
    /**
     * Metoda koja ukljanja komentar
     * 
     * @param int $idKom primarni kljuc tabele komentar
     * @return type
     * 
     * @author Ognjen Subaric 0425/17
     */
    public function ukloniKomentar($idKom){
        $komentarModel = new KomentarModel();
        $objavaModel->delete($idKom);        
        return redirect()->to(site_url("Admin/index"));
    }
    

}