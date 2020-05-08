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

use CodeIgniter\Controller;
use App\Models\ObjavaModel;
use App\Models\KorisnikModel;

/*
 * Klasa BaseController - sluzi za implementaciju metoda zajednickih za sve tipove korisnika aplikacije
 * 
 * @version 1.0
 */

class BaseController extends Controller
{

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
		$this->session = \Config\Services::session();
        
	}
        /*
         * Zasticena metoda prikaz cija se implementacija nalazi u potklasama klase BaseController
         * @param string $page String
         * @param string[] $data String[]
         */
        protected function prikaz($page, $data) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }
    
    
    /*
     * Metoda index - podrazumevana metoda koja prikazuje sve postojece objave bez filtriranja , rasporedjene po stranicama 
     * 
     * @autor Aleksandar Matic
     */
    public function index(){
        $objavaModel=new ObjavaModel();
        $data = [
            'filtrirano' => false,
            'objave' => $objavaModel->paginate(10),
            'pager' => $objavaModel->pager
        ];
        $this->prikaz('pregledSvihObjava',$data);
    }
    
    /**
     * Metoda objava - prikazuje pojedinacnu objavu
     * 
     * @author Aleksandra Bogicevic 0390/17
     * 
     * @param type $id
     */
     public function objava($id){
        $objavaModel=new ObjavaModel();
        $objava=$objavaModel->find($id);
        $this->prikaz('pojedinacnaObjava', ['objava'=>$objava]);
    }
    
    /*
     * Metoda filteri - sluzi za otvaranje stranice za izbor filtera pri filtriranju objava 
     * 
     * @autor Aleksandar Matic
     */
    public function filteri(){
        $_SESSION['datum_od'] = null;
        $_SESSION['datum_do'] = null;
        $_SESSION['mesto'] = null;
        $_SESSION['vreme_od'] = null;
        $_SESSION['vreme_do'] = null;
        
        $this->prikaz('filteri', []);
    }
    
    /*
     * Metoda filtriraj - sluzi za primenu izabranih filtera i ispisivanje rezultata ukoliko oni postoje , rasporedjenih po stranama
     * 
     * @var ObjavaModel $objavaModel
     * 
     * @autor Aleksandar Matic
     */
    public function filtriraj(){
        $objavaModel = new ObjavaModel();
        
        if(empty($_SESSION['datum_od']) && empty($_SESSION['datum_do']) && empty($_SESSION['mesto']) && empty($_SESSION['vreme_od']) && empty($_SESSION['vreme_do'])){
        $_SESSION['datum_od']= $this->request->getVar('datum_od');
        $_SESSION['datum_do'] =$this->request->getVar('datum_do');
        $_SESSION['mesto'] = $this->request->getVar('mesto');
        $_SESSION['vreme_od'] = $this->request->getVar('vreme_od');
        $_SESSION['vreme_do'] = $this->request->getVar('vreme_do');
        }
        
        $data = [
            'filtrirano' => true,
            'objave' =>  $objavaModel->dohvatiPoFilterima($_SESSION['datum_od'],$_SESSION['datum_do'],$_SESSION['mesto'],$_SESSION['vreme_od'],$_SESSION['vreme_do']),
            'pager' => $objavaModel->pager,
        ];
        
        $this->prikaz('pregledSvihObjava', $data);
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
    
     /*
     * Metoda podrska - stavka menija kada je korisnik ulogovan
     * Prikazuje stranicu sa podrskom
     * 
     * @author Aleksandra Bogicevic 0390/17
     * 
     */
     public function podrska(){
         $korisnik_id = $this->session->get('korisnik_id');
         
         if($korisnik_id == null){
              $this->prikaz('podrskaZaGosta' , []);
              return;
         }
        $this->prikaz('podrska' , []);
    }
    
}
