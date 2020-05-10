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
                $this->db = \Config\Database::connect();
        
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
}
