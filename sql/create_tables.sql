-- Lisää CREATE TABLE lauseet tähän tiedostoon
CREATE TABLE Aihealue(
	id SERIAL PRIMARY KEY,
	nimi varchar(32) NOT NULL
);

CREATE TABLE Kayttaja(
	id SERIAL PRIMARY KEY,
	nimi varchar(16) NOT NULL,
	admin boolean NOT NULL
);

CREATE TABLE Keskustelu(
	id SERIAL PRIMARY KEY,
	aihealue_id INTEGER REFERENCES Aihealue(id),
	kayttaja_id INTEGER REFERENCES Kayttaja(id),
	otsikko varchar(32) NOT NULL
);

CREATE TABLE Viesti(
	id SERIAL PRIMARY KEY,
	keskustelu_id INTEGER REFERENCES Keskustelu(id),
	kayttaja_id INTEGER REFERENCES Kayttaja(id),
	sisalto varchar(1000) NOT NULL,
	aika timestamp DEFAULT now()
);

CREATE TABLE Luettu(
	keskustelu_id INTEGER REFERENCES Keskustelu(id),
	kayttaja_id INTEGER REFERENCES Kayttaja(id)
);