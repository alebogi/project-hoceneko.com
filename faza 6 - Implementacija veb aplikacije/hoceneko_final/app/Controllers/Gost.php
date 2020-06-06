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
        echo view('sablon/header_gost', $data);
        echo view('sablon/kategorije', $data);
        
        echo view ("stranice/$page", $data);
        
        echo view('sablon/reklame');
        echo view('sablon/footer');
    }
    
    
      /**
     * Funckija koja se poziva pri logovanju, ako postoji poruka ispisace se u login.php
     * 
     * @param string $poruka poruka koja se prikazuje 
     * @author Nikola Milicevic 0387/17
     */
  
    public function login($puruka=null){
        $this->prikaz('login', ['poruka'=>$puruka]);
    }
    
     /**
     * Funckija koja obradjuje zahtev poslat kroz formu iz login.php i redirectuje ili ispisuje odgovarajuce greske
     * 
     *  
     * @author Nikola Milicevic 0387/17
     */
    
    
    public function loginSubmit(){
        if(!$this->validate(['korisnicko_ime'=>'required', 'lozinka'=>'required'])){
            return $this->prikaz('login', 
                ['errors'=>$this->validator->getErrors()]);
        }
        
        $korisnikModel = new KorisnikModel();
        $korisnik = $korisnikModel->where('korisnicko_ime',$this->request->getVar('korisnicko_ime'))->first();
        if($korisnik==null){
            return $this->login("Korisnik ne postoji");
        }
        if($korisnik->lozinka!=$this->request->getVar('lozinka')){
            return $this->login("Pogresna lozinka!");
        }
        
        
        $this->session->set('korisnik',$korisnik);
        if($korisnik->tip == "obican")
        return redirect()->to(site_url('Korisnik'));
        else 
            return redirect()->to(site_url('Admin'));
    }
    
    /**
     * Funckija koja se poziva iz kontrolera Gost za registraciju 
     * 
     *  
     * @author Nikola Milicevic 0387/17
     */
    
    public function register($poruka=null){
        $this->prikaz('register', ['poruka'=>$poruka]);
    }
    
    /**
     * Funkcija koja obradjuje zahtev za registrovanjem poslat iz register.php uz odgovarajuce provere 
     * @author Nikola Milicevic 0387/17
     */
    
    public function registerSubmit(){
        if(!$this->validate([
            'korisnicko_ime' => 'required|min_length[5]|max_length[20]',
            'lozinka' => 'required|min_length[6]',
            'lozinka_p' => 'required|min_length[6]',
            'ime' => 'required',
            'prezime' => 'required',
            'e_mail' => 'trim|required|valid_email',
            'pol' => 'required',
            'datum_rodjenja' => 'required',
            'opis' => 'required|min_length[5]|max_length[999]',
        ])){
            return $this->prikaz('register', ['errors'=>$this->validator->listErrors()]);
        }
        //vidi jel postoji korisnik
        $korisnikModel = new KorisnikModel();
        $korisnik = $korisnikModel->where('korisnicko_ime',$this->request->getVar('korisnicko_ime'))->first();
        if($korisnik!=null){ // vec postoji
            return $this->register("Korisnicko ime vec postoji, unesite drugo");
            
        }
        if($this->request->getVar('lozinka')!=$this->request->getVar('lozinka_p')){
            return $this->register("Lozinke se ne poklapaju, pokusajte ponovo");
            
        }
        
        if($this->request->getVar('korisnicko_ime')==$this->request->getVar('lozinka')){
            return $this->register("Korisnicko ime i lozinka ne smeju biti isti");
            
        }
       
        //---------------- puzimanje ekstenzije slike
        $target_dir = "../../public/uploads";
        $target_file = $target_dir . basename($_FILES["profilna_slika"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        if($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "jfif") {
               return  $this->prikaz('register', ['poruka'=>"Dozvoljeni su samo JPG i JPEG fajlovi"]);
        }
        //----------
        
        $file = $this->request->getFile('profilna_slika');
        if (! $file->isValid()) {
                return $this->register("Doslo je do greske prilikom postavljanja slike");
        }
        
        $path = $file->store('../../public/uploads',$this->request->getVar('korisnicko_ime')."_profilna.jpg");
        
        if($this->request->getVar('saglasnost')=="Ne"){
            return $this->register("Morate da prihvatite uslove koriscenja da biste napravili nalog.");
            
        }
        
       $korisnikModel->save([
               'korisnicko_ime' => $this->request->getVar('korisnicko_ime'),
               'lozinka' => $this->request->getVar('lozinka'),
               'ime'=> $this->request->getVar('ime'),
               'prezime'=> $this->request->getVar('prezime'),
               'datum_rodjenja' => $this->request->getVar('datum_rodjenja'),
               'e_mail' => $this->request->getVar('e_mail'),
               'opis' => $this->request->getVar('opis'),
               'pol' => $this->request->getVar('pol'),
               'tip' => 'obican',
               'ocena' => 0,
               'profilna_slika'=> "$path", //default path je public/uploads
           ]);

        $novi_korisnik = $korisnikModel->where('korisnicko_ime',$this->request->getVar('korisnicko_ime'))->first();
 
        $this->session->set('korisnik',$novi_korisnik);
        return redirect()->to(site_url('Korisnik'));
    }
    
    
    /**
     * Metoda za prikaz uslova koriscenja
     * @author Aleksandra Bogicevic 0390/17
     */
    public function usloviKoriscenja(){
        echo view('stranice/TermsAndConditions');
    }
    
    /**
     * Metoda za prikaz privacy policy
     * @author Aleksandra Bogicevic 0390/17
     */
     public function privacy(){
         echo view('stranice/PrivacyPolicy');
    }
}
     

