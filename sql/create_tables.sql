-- Lisää CREATE TABLE lauseet tähän tiedostoon
CREATE TABLE Aihealue(
	id SERIAL PRIMARY KEY,
	nimi varchar(32) NOT NULL
);

CREATE TABLE Kayttaja(
	id SERIAL PRIMARY KEY,
	nimi varchar(16) NOT NULL,
	oikeudet varchar(10) NOT NULL
);

CREATE TABLE Keskustelu(
	id SERIAL PRIMARY KEY,
	keskustelu_id INTEGER REFERENCES Keskustelu(id),
	kayttaja_id INTEGER REFERENCES Kayttaja(id),
	otsikko varchar(32) NOT NULL
);

CREATE TABLE Viesti(
	id SERIAL PRIMARY KEY,
	viesti_id INTEGER REFERENCES Viesti(id),
	kayttaja_id INTEGER REFERENCES Kayttaja(id),
	sisalto varchar(1000) NOT NULL
);

CREATE TABLE Luettu(
	keskustelu_id INTEGER REFERENCES Keskustelu(id),
	kayttaja_id INTEGER REFERENCES Kayttaja(id),
);