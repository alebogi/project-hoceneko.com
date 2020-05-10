<?php
/**
 * @author Aleksandra Bogicevic 0390/17
 */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/bootstrap-4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/bootstrap-4.4.1/js/bootstrap.min.js">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="shortcut icon" href="/img/favicon.ico">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <title>hoceneko</title>
</head>
<body class="bg">
    <div class="cotainer-fluid">
        <!-- pocetak header-a korisnika -->
        <div class="row headerKorisnik">
            <div class="col-sm-4 col-md-4 col-lg-4 logoMesto">
                <img id="logo" src="/img/logo.png">
            </div>
            <div class="col-sm-8 col-md-8 col-lg-8">
                <div class="row headerBtns">
                    <div class="col-sm-6 col-md-6 col-lg-6">

                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-6 colHdrBtnsAndName">
                        <span>Dobrodosli, </span>
                         <?php  echo $korisnik->ime." ".$korisnik->prezime." "; ?>  
                         <?= anchor("Korisnik/logout", "Izloguj se",'class="btn btn-sm btn-info"') ?>
                    </div>
                </div>
                <div class="col-sm-2 col-md-2 col-lg-2">

                </div>
                <div class="row headerKorisnikNavbar">
                    <div class="col-sm-8 col-md-8 col-lg-8 d-flex p-2 justify-content-left  align-items-center navbar-inverse">
                          <nav class="navbar navbar-expand-xl navbar-dark ">
                            <div class="collapse navbar-collapse" id="navbarText">
                              <ul class="navbar-nav mr-auto">
                                <li class="nav-item active">
                                  <a class="nav-link" href="<?= site_url("Korisnik/index")?>">Pocetna <span class="sr-only">(current)</span></a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link" href="<?= site_url("Korisnik/mojProfil")?>">Moj profil </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?= site_url("Korisnik/postavljanjeObjave")?>">Dodaj objavu</a>
                                  </li>
                                  <li class="nav-item">
                                    <a class="nav-link" href="<?= site_url("Korisnik/podrska")?>">Podrska</a>
                                  </li>
                                <li class="nav-item">
                                  <?=anchor("$controller/pregledInfo", 'O nama', array('class' => 'nav-link'));?>
                                </li>
                              </ul>
                            </div>
                        </nav>
                    </div>
                    <div class="col-sm-2 col-md-2 col-lg-2">

                    </div>
                </div>
            </div>
        </div>
        <!-- kraj header-a za korisnika -->