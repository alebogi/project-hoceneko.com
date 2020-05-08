<?php namespace App\Controllers;

/**
 * Gost - kontroler koji pozivaju osobe koje nisu ulogovane
 * 
 * @version 1.0
 * 
 * @author Ognjen Subaric 0425/17
 */
class Gost extends BaseController {
    
    /**
     * Modularna funckija na osnovu koje se bira centralni view
     * 
     * @param string $page stranica na koju se skace
     * @param array $data niz podataka potreban odgovarajucoj stranici
     */
    protected function prikaz($page, $data = NULL) {
        $data['controller']='Gost';
        echo view('sablon/header_gost', $data); //ili header_korisnik
        echo view('sablon/kategorije', $data);
        
        echo view("stranice/$page", $data);
        
        echo view('sablon/reklame');
        echo view('sablon/footer');
    }   
}
