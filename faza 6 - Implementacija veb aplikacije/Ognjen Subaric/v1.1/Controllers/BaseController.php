<?php
namespace App\Controllers;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 *
 * @package CodeIgniter
 */
use App\Models\ObjavaModel;
use App\Models\KorisnikModel;
use App\Models\KomentarModel;
use CodeIgniter\Controller;

/**
 * BaseController - klasa iz koje se izvode svi ostali controller-i
 * 
 * @version 1.0
 */
class BaseController extends Controller {    
    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = ['form', 'url'];

    /**
     * Constructor.
     */
    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
    {
            // Do Not Edit This Line
            parent::initController($request, $response, $logger);

            //--------------------------------------------------------------------
            // Preload any models, libraries, etc, here.
            //--------------------------------------------------------------------
            // E.g.:
        $this->session = session();
    }

    /**
     * Funckija za bacanje greske ukoliko se pristupa stranici koja nije definisana
     * 
     * @param string $page ime stranice
     * @param array $data podaci potrebni za ucitavanje stranice
     * @throws PageNotFoundException
     * 
     * @author Ognjen Subaric 0425/17
     */
    protected function prikaz($page, $data) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }
    
    /**
     * Podrazumevana funckija koja zove pocetnu stranu
     * 
     * @author Ognjen Subaric 0425/17
     */
    public function index(){
        $this->prikaz('primerMain', ['']);
    }
    
    /**
     * Funcija za prebacivanje na stranicu sa informacijama
     * 
     * @author Ognjen Subaric 0425/17
     */
    public function pregledInfo(){
        $this->prikaz('Info', ['']);
    }
    
    /**
     * Funkcija koja vrsi pretragu na odredjenu kategoriju
     * 
     * @param string $kategorija kategorija na osnovu koje se vrsi pretraga
     * 
     * @author Ognjen Subaric 0425/17
     */
    public function mojaPretraga($kategorija){
        $objavaModel = new ObjavaModel();
        $this->session->set('kategorija', $kategorija);
        $objave = $objavaModel->pretraga($kategorija);
        $korisnikModel = new KorisnikModel();
        $korisnickoIme = array();
        foreach ($objave as $objava){
            $korisnickoIme += [$objava->idKor => $korisnikModel->dohvatiKorisnickoIme($objava->idKor)];
        }
        $this->prikaz('Objave', ['objave'=>$objave, 'korIme'=>$korisnickoIme]);     
    }
    
    /**
     * Funckija kojom se sortiraju objave iz trenutnog prikaza
     * 
     * @author Ognjen Subaric 0425/17
     */
    public function sortiranje(){        
        if(isset($_GET['sortiraj'])){
            $poruka = $_GET['tipSortiranja'];
            $poruka = explode(" ", $poruka);
            if($poruka[1] == "ASC")
                $poruka[1] = "rastuce";     
            else
                $poruka[1] = "opadajuce";
            switch ($poruka[0]){
                case "datum":
                    $poruka[0] =  "Sortirano po datumu, ";
                    break;
                case "ocena":
                    $poruka[0] = "Sortirano po oceni, ";
                    break;
                case "br_potrebnih_clanova":
                    $poruka[0] = "Sortirano po broju trazenih ljudi, ";
                    break;
            }
        }
        $objavaModel = new ObjavaModel();
        $kriterijum = $this->request->getVar('tipSortiranja');
        $kriterijum = explode(" ", $kriterijum);
        $kategorija = $_SESSION['kategorija'];
        $objave = $objavaModel->pretragaSort($kriterijum[0], $kriterijum[1], $kategorija);
        $korisnikModel = new KorisnikModel();
        $korisnickoIme = array();
        foreach ($objave as $objava){
            $korisnickoIme += [$objava->idKor => $korisnikModel->dohvatiKorisnickoIme($objava->idKor)];
        }
        $this->prikaz('Objave', ['objave'=>$objave, 'poruka'=>$poruka, 'korIme'=>$korisnickoIme]); 
    }
    
    ////////////////////////////////////////////////////////////////////////////////////////////////
    
    /**
    * Metoda objava - prikazuje pojedinacnu objavu
    * 
    * @author Aleksandra Bogicevic 0390/17
    * @author Ognjen Subaric 0425/17
    * 
    * @param type $id
    */
    public function objava($idObj){
       $objavaModel=new ObjavaModel();
       $objava=$objavaModel->find($idObj);
       $komentarModel = new KomentarModel();
       $komentari = $komentarModel->dohvatiKomentare($idObj);
       $this->prikaz('pojedinacnaObjava', ['objava'=>$objava, 'komentari'=>$komentari]);
    }
    
    /*
     * Metoda profil - sluzi za preusmeravanje na profil odabranog korisnika
     * 
     * 
     * @autor Aleksandra Bogicevic 0390/17
     */
    public function profil($id){
        $korisnikModel=new KorisnikModel();
        $korisnik=$korisnikModel->find($id);
        $this->prikaz('pregledProfila', ['korisnik'=>$korisnik]);
    }
}
