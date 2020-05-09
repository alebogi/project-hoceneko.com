<?php namespace App\Controllers;

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
}
