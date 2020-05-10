<?php namespace App\Controllers;

use App\Models\KomentarModel;
use App\Models\ObjavaModel;

/**
 * Korisnik - kontroler koji pozivaju osobe koje su ulogovane
 * 
 * @version 1.0
 * 
 * @author Ognjen Subaric 0425/17
 */
class Korisnik extends BaseController {
    /**
     * Modularna funckija na osnovu koje se bira centralni view
     * 
     * @param string $page stranica na koju se skace
     * @param array $data niz podataka potreban odgovarajucoj stranici
     */
    protected function prikaz($page, $data) {
        $data['controller']='Korisnik';
        //$data['autor']=$this->session->get('autor');
        echo view('sablon/header_gost', $data); //ili header_korisnik
        echo view('sablon/kategorije', $data);
        
        echo view("stranice/$page", $data);
        
        echo view('sablon/reklame');
        echo view('sablon/footer');
    }
    
    /**
     * Metoda za postavljanje komentara na odredjenoj objavi
     * 
     * @param int $idObj primarni kljuc objave
     * 
     * @author Ognjen Subaric 0425/17
     */
    public function postaviKomentar($idObj) {
        //global $url;
        //$korisnik=$this->session->get('komentar');
        //if(isset($_POST['komentar'])){
        if(isset($_GET['submitKom']) && $_GET['randcheck']==$_SESSION['rand'] && $_GET['komentar']!='') {
            $komentarModel = new KomentarModel();
            $korisnik=$this->session->get('korisnik');
            $komentarModel->ubaciKomentar($_GET['komentar'], $korisnik->idKor, $idObj);
            //unset($_POST);
            //current_url([$returnObject = false])=site_url("$controller/objava/{$objava->idObj}");
            
            //redirect(site_url("$controller/objava/{$objava->idObj}"), 'refresh');
        }
        $this->objava($idObj);
    }
    
    /**
     * Pomocna metoda za unosenje podataka o prijavi za dogadjaj u bazi
     * 
     * @param int $idObj primarni kljuc objave
     * @param int $idKor primarni kljuc korisnika
     * 
     * @author Ognjen Subaric 0425/17
     */
    private function upisiPrijavu($idObj, $idKor){
        $db      = \Config\Database::connect();
        $builder = $db->table('prijavljen');
        $data = [
            "idKor"=>$idKor,
            "idObj"=>$idObj
        ];
        $builder->insert($data);
    }
    
    /**
     * Pomocna metoda koja proverava da li je korisnik vec prijavljen na dogadjaj
     * 
     * @param int $idObj primarni kljuc objave
     * @param int $idKor primarni kljuc korisnika
     * @return boolean   da li priajva vec postoji
     * 
     * @author Ognjen Subaric 0425/17
     */
    private function proveraPostoji($idObj, $idKor){
        $db      = \Config\Database::connect();
        $builder = $db->table('prijavljen');
        $builder->select('*');
        $builder->where('idKor', $idKor);
        $builder->where('idObj', $idObj);
        if($builder->countAllResults() > 0)
            return true;
        return false;
    }
    
    /**
     * Metoda za prijavu korisnika za dogadjaj
     * 
     * @param int $idObj primaran kljuc objave
     * 
     * @author Ognjen Subaric 0425/17
     */
    public function prijavaDogadjaj($idObj){
        $objavaModel = new ObjavaModel();
        $korisnik=$this->session->get('korisnik');
        $brPotrebnihClanova = $objavaModel->dohvatiBrPotrebnihClanova($idObj);
        $brPrijavljenihClanova = $objavaModel->dohvatiBrPrijavljenihClanova($idObj);
        //if(($objavaModel->dohvatiBrPotrebnihClanova($idObj)>$objavaModel->dohvatiBrPrijavljenihClanova($idObj)) && (!$this->proveraPostoji($idObj, $korisnik->idKor))){
        if(($brPotrebnihClanova>$brPrijavljenihClanova) && (!$this->proveraPostoji($idObj, $korisnik->idKor))){
            $objavaModel->povecajBrPrijavljenih($idObj);          
            $this->upisiPrijavu($idObj, $korisnik->idKor);           
            $this->objava($idObj);
        }
        //else if(!($objavaModel->dohvatiBrPotrebnihClanova($idObj)>$objavaModel->dohvatiBrPrijavljenihClanova($idObj))){
        else if(!($brPotrebnihClanova>$brPrijavljenihClanova)){
            $this->session->set("porukaGreska", "Sva mesta popunjena!");
            $this->objava($idObj);
        }
        else{
            $this->session->set("porukaGreska", "Vec si prijavljen!");
            $this->objava($idObj);
        }
    }
    
    //////////////////////////////////////////////////////////////////////////////
    /**
     * Metoda mojProfil - sluzi za prikazivanje prodila ulogovanog korisnika klikom na odredjeno dugme u meniju
     * 
     * @author Aleksandra Bogicevic 0390/17
     */
    public function mojProfil(){
        $korisnik=$this->session->get('korisnik');
        $this->prikaz('mojProfil', ['korisnik'=>$korisnik]);
    }
}
