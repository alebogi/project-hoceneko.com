
CREATE TABLE Komentar
(
	idKom                INTEGER NOT NULL,
	sadrzaj              VARCHAR(100) NOT NULL,
	idObj                INTEGER NOT NULL,
	idKor                INTEGER NOT NULL
);

ALTER TABLE Komentar
ADD CONSTRAINT XPKKomentar PRIMARY KEY (idKom);

CREATE TABLE Korisnik
(
	idKor                INTEGER NOT NULL,
	korisnicko_ime       VARCHAR(20) NOT NULL,
	lozinka              VARCHAR(20) NOT NULL,
	ime                  VARCHAR(20) NOT NULL,
	prezime              VARCHAR(20) NOT NULL,
	pol                  VARCHAR(6) NOT NULL,
	e_mail               VARCHAR(40) NOT NULL,
	datum_rodjenja       DATE NOT NULL,
	tip                  VARCHAR(10) NOT NULL DEFAULT obican,
	ocena                DECIMAL(10,2) NULL,
	opis                 VARCHAR(255) NULL,
	profilna_slika       VARCHAR(255) NULL
);

ALTER TABLE Korisnik
ADD CONSTRAINT XPKKorisnik PRIMARY KEY (idKor);

CREATE TABLE Objava
(
	idObj                INTEGER NOT NULL,
	naziv                VARCHAR(20) NOT NULL,
	kategorija           VARCHAR(20) NOT NULL,
	br_potrebnih_clanova INTEGER NOT NULL,
	br_prijavljenih_clanova INTEGER NOT NULL DEFAULT 0,
	datum                DATE NOT NULL,
	vreme                TIME NOT NULL,
	mesto                VARCHAR(20) NOT NULL,
	opis                 VARCHAR(999) NULL,
	tip                  VARCHAR(10) NOT NULL DEFAULT besplatna,
	idKor                INTEGER NOT NULL
);

ALTER TABLE Objava
ADD CONSTRAINT XPKObjava PRIMARY KEY (idObj);

CREATE TABLE Ocenio
(
	idOcenio             INTEGER NOT NULL,
	idOcenjen            INTEGER NOT NULL,
	tip_ocene            VARCHAR(10) NOT NULL
);

ALTER TABLE Ocenio
ADD CONSTRAINT XPKOcenio PRIMARY KEY (idOcenio,idOcenjen);

CREATE TABLE Prijavljen
(
	idKor                INTEGER NOT NULL,
	idObj                INTEGER NOT NULL
);

ALTER TABLE Prijavljen
ADD CONSTRAINT XPKPrijavljen PRIMARY KEY (idKor,idObj);

CREATE TABLE Zahtev
(
	idZah                INTEGER NOT NULL,
	tema                 VARCHAR(20) NOT NULL,
	opis                 VARCHAR(999) NOT NULL,
	status               VARCHAR(20) NOT NULL,
	idKor                INTEGER NOT NULL
);

ALTER TABLE Zahtev
ADD CONSTRAINT XPKZahtev PRIMARY KEY (idZah);

ALTER TABLE Komentar
ADD CONSTRAINT R_4 FOREIGN KEY (idObj) REFERENCES Objava (idObj);

ALTER TABLE Komentar
ADD CONSTRAINT R_5 FOREIGN KEY (idKor) REFERENCES Korisnik (idKor);

ALTER TABLE Objava
ADD CONSTRAINT R_1 FOREIGN KEY (idKor) REFERENCES Korisnik (idKor);

ALTER TABLE Ocenio
ADD CONSTRAINT R_14 FOREIGN KEY (idOcenio) REFERENCES Korisnik (idKor);

ALTER TABLE Ocenio
ADD CONSTRAINT R_15 FOREIGN KEY (idOcenjen) REFERENCES Korisnik (idKor);

ALTER TABLE Prijavljen
ADD CONSTRAINT R_12 FOREIGN KEY (idKor) REFERENCES Korisnik (idKor);

ALTER TABLE Prijavljen
ADD CONSTRAINT R_13 FOREIGN KEY (idObj) REFERENCES Objava (idObj);

ALTER TABLE Zahtev
ADD CONSTRAINT R_16 FOREIGN KEY (idKor) REFERENCES Korisnik (idKor);
