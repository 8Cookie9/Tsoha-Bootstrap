-- Lisää INSERT INTO lauseet tähän tiedostoon
INSERT INTO Kayttaja(nimi, oikeudet) VALUES ('user1','regular');
INSERT INTO Kayttaja(nimi, oikeudet) VALUES ('user2','regular');
INSERT INTO Kayttaja(nimi, oikeudet) VALUES ('admin','admin');
INSERT INTO Aihealue(nimi) VALUES ('Yleistä');
INSERT INTO Keskustelu(keskustelu_id, kayttaja_id, otsikko) VALUES (1,1,'Yleinen keskustelu');
INSERT INTO Viesti(kayttaja_id, sisalto) VALUES (1,'Random message');