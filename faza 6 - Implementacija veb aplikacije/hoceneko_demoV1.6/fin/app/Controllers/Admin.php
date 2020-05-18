<?php namespace App\Controllers;

use App\Models\ObjavaModel;
use App\Models\KorisnikModel;
use App\Models\KomentarModel;
use App\Models\OcenioModel;
use App\Models\ZahtevModel;

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
        
        $data['controller']='Admin';;
        $data['korisnik']=$this->session->get('korisnik');
        
        echo view('sablon/header_korisnik',$data);
        echo view('sablon/kategorije',$data);
         
        //u slucaju da treba da se prikaze neciji profil, treba proveriti da li cemo prikazati profil kao da je nas ili ne
        if($page=="pregledProfila"){
            if ($data['korisnik']->idKor == $data['drugiKorisnik']->idKor)
                $page = "mojProfil";
        }
        echo view ("stranice/$page", $data);
        
        echo view('sablon/reklame');
        echo view('sablon/footer');
    }
    
    /**
     * 
     * @param type $idObjave
     * @return type
     * 
     * @author Aleksandar Matic
     */
    public function ukloniObjavu($idObjave){
        $objavaModel = new ObjavaModel();
        $objavaModel->delete($idObjave);
        
        $komentarModel = new KomentarModel();
        $komentarModel->where('idObj', $idObjave)->delete();   
        
        $this->db->table('prijavljen')->where('idObj',$idObjave)->delete();
        
        return redirect()->to(site_url("Admin/index"));
    }
    
    /**
     * Funckija ukloniKorisnika - sluzi za uklanjanje korisnika iz baze podataka
     * @param type $idObjave
     * @return type
     * 
     * @author Nikola Milicevic
     * @coauthor Aleksandar Matic
     */
    public function ukloniKorisnika($idKor){
        $korisnikModel = new KorisnikModel();
        $korisnik = $korisnikModel->find($idKor);
        if($korisnik->tip == 'admin'){
            $this->session->set('porukaGreska','Ne mozete ukloniti drugog administratora!');
            return redirect()->to(site_url("Admin/profil/$idKor"));
        }
        $korisnikModel->delete($idKor);
        
        $ocenioModel = new OcenioModel();
        $ocenioModel->where('idOcenjen',$idKor)->delete();
        
        $objavaModel = new ObjavaModel();
        $objaveZaBrisanje = $objavaModel->where('idKor',$idKor)->findAll();
        
        foreach($objaveZaBrisanje as $objava){
            $komentarModel = new KomentarModel();
            $komentarModel->where('idObj',$objava->idObj)->delete();
            
            $this->db->table('prijavljen')->where('idObj' ,$objava->idObj)->delete();
            $objavaModel->delete($objava->idObj);
        }
        return redirect()->to(site_url("Admin/index"));
    }
    
    /**
     * Metoda koja ukljanja komentar
     * 
     * @param int $idKom primarni kljuc tabele komentar
     * @return type
     * 
     * @author Ognjen Subaric 0425/17
     * @coauthor Aleksandar Matic 0334/17
     */
    public function ukloniKomentar($idKom){
        $komentarModel = new KomentarModel();
        $idObj = $komentarModel->find($idKom)->idObj;
        $komentarModel->delete($idKom);        
        return redirect()->to(site_url("Admin/objava/$idObj"));
    }
    
    /**
     * @author Aleksandar Matic 
     */
    public function postavljanjeObjave(){
        
        $this->prikaz('postavljanjeObjave' , []);
    }
    
    /**
     * @author Aleksandar Matic 
     */
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
       else $tip = 'besplatna';
       $korisnik = $this->session->get('korisnik');
       $korisnik_id = $korisnik->idKor;
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
       return redirect()->to(site_url("Admin/index"));
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
    
     /**
     * Metoda mojeObjave - sluzi za prikazivanje objava ulogovanog korisnika
     * 
     * @author Aleksandar Matic 
     */
    public function mojeObjave(){
        $korisnik = $this->session->get('korisnik');
        $objavaModel = new ObjavaModel();
        
        $data = [
            'prikaz' => 'moje_objave',
            'objave' => $objavaModel->where('idKor',$korisnik->idKor)->paginate(10),
            'pager' => $objavaModel->pager,
        ];
        
        $this->prikaz('prikazPoStranicama', $data);
      
    }
    
    /**
     * Metoda pormenaSlike - sluzi za promenu profilne slike korisnika
     * 
     * @author Aleksandra Bogicevic 0390/17
     */
    public function promenaSlike(){
        $korisnik=$this->session->get('korisnik');
        
        
        //---------------- puzimanje ekstenzije slike
        $target_dir = "../../public/uploads";
        $target_file = $target_dir . basename($_FILES["profilna_slika"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        if($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "jfif") {
               return  $this->prikaz('mojProfil', ['poruka'=>"Dozvoljeni su samo JPG, JPEG i JFIF fajlovi"]);
        }
        //----------
        
        $file = $this->request->getFile('profilna_slika');
        
        if (! $file->isValid())
        {
                return  $this->prikaz('mojProfil', []);
        }
        
        //provera
        $korisnikModel1 = new KorisnikModel();
         $korisnikIzBaze = $korisnikModel1->find($korisnik->idKor);
                                
        if (!empty($korisnikIzBaze->profilna_slika)) {
            unlink("../public/uploads/"."$korisnik->korisnicko_ime"."_profilna.jpg");
        } //prvo obrisemo postojecu
        
        
        $path = $file->store('../../public/uploads',$korisnik->korisnicko_ime."_profilna.jpg");
        
        $data = array(
        'korisnicko_ime' => $korisnik->korisnicko_ime,
        'slika' => $path
        );

        $korisnikModel = new KorisnikModel(); // First load the model
        $korisnikModel->update_photo($data);
        
         if($korisnikModel->update_photo($data)){ // call the method from the controller
          // update uspesan...
             return redirect()->to(site_url("Admin/mojProfil"));
        }else{
        // update neuspesan...
            return  $this->prikaz('mojProfil', ['poruka'=>"Doslo je do grese pri promeni slike."]);
        }
    
        
        
    }
   
    
    /*
     * Metoda podrskaPotvrda - salje pitanje korisnika
     * 
     * @author Aleksandra Bogicevic 0390/17
     * 
     */
    public function podrskaPotvrda(){
        $korisnik = $this->session->get('korisnik');

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
               'idKor' => $korisnik->idKor,
               'status' => $status
           ]);
       
       return redirect()->to(site_url("Admin/podrskaPotvrdjeno"));
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

      /* Funkcija za odjavu ulogovanog korisnika
     * 
     * 
     * @author Nikola Milicevic 0387/17
     */
    
    
    public function logout(){
        $this->session->destroy();
        return redirect()->to(site_url('Gost'));
    }
    
     public function odjava(){
        $this->session->destroy();
        return redirect()->to(site_url('Gost'));
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
    
     
    /**
     * Funkcija koja ocenjuje negativno korisnika kog smo prosledili kao parametar
     * @author Nikola Milicevic 0387/17
     * @param int $idZaOcenu
     * 
     */
    
    public function ocenaNegativna($idZaOcenu){
        $korisnik = $this->session->get('korisnik');
        
        
        $ocenjuje = $korisnik->idKor;
        $ocenioModel = new OcenioModel();
        
        $rezultati = $ocenioModel->where('idOcenjen',$idZaOcenu)->findAll();
        
            foreach($rezultati as $res){
                if((int)$res->idOcenio == (int)$ocenjuje){
                    return redirect()->to(site_url("Admin/profil/$idZaOcenu"));
                }
            }
        
        $dataOcena = [
            'idOcenio' => $ocenjuje,
            'idOcenjen' => $idZaOcenu,
            'tip_ocene' => "negativna",
        ];
        $ocenioModel->insert($dataOcena);
        
        $korisnikModel = new KorisnikModel();
        $ocenjen = $korisnikModel->find($idZaOcenu);
        $novaOcena = $ocenjen->ocena - 1;
        $dataKor = [
            'ocena' => $novaOcena,
        ];
        $korisnikModel->update($idZaOcenu,$dataKor);
        return redirect()->back();
        
    }
    
    /**
     * Funkcija koja ocenjuje pozitivno korisnika kog smo prosledili kao parametar
     * @author Nikola Milicevic 0387/17
     * @param int $idZaOcenu
     * 
     */
    
    public function ocenaPozitivna($idZaOcenu){
        $korisnik = $this->session->get('korisnik');
        
        
        $ocenjuje = $korisnik->idKor;
        $ocenioModel = new OcenioModel();
        
        $rezultati = $ocenioModel->where('idOcenjen',$idZaOcenu)->findAll();
        
            foreach($rezultati as $res){
                if((int)$res->idOcenio == (int)$ocenjuje){
                    return redirect()->to(site_url("Admin/profil/$idZaOcenu"));
                }
            }
        
        $dataOcena = [
            'idOcenio' => $ocenjuje,
            'idOcenjen' => $idZaOcenu,
            'tip_ocene' => "pozitivna",
        ];
        $ocenioModel->insert($dataOcena);
        
        $korisnikModel = new KorisnikModel();
        $ocenjen = $korisnikModel->find($idZaOcenu);
        $novaOcena = $ocenjen->ocena + 1;
        $dataKor = [
            'ocena' => $novaOcena,
        ];
        $korisnikModel->update($idZaOcenu,$dataKor);
        return redirect()->back();
        
    }

}