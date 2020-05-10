<?php namespace App\Controllers;

use App\Models\ObjavaModel;
use App\Models\KorisnikModel;
use App\Models\ZahtevModel;

class Korisnik extends BaseController
{
    protected function prikaz($page, $data) {
        
        $data['controller']='Korisnik';
        $data['korisnik']=$this->session->get('korisnik');
        
        echo view('sablon/header_korisnik',$data);
        echo view('sablon/kategorije');
         
        
        //u slucaju da treba da se prikaze neciji profil, treba proveriti da li cemo prikazati profil kao da je nas ili ne
        if($page=="pregledProfila"){
            if ($data['korisnik']->idKor == $data['drugiKorisnik']->idKor)
                $page = "mojProfil";
        }
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
             return redirect()->to(site_url("Korisnik/mojProfil"));
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
