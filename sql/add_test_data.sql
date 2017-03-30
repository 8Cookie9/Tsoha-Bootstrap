-- Lisää INSERT INTO lauseet tähän tiedostoon
INSERT INTO Kayttaja(nimi, admin) VALUES ('user1',false);
INSERT INTO Kayttaja(nimi, admin) VALUES ('user2',false);
INSERT INTO Kayttaja(nimi, admin) VALUES ('admin',true);
INSERT INTO Aihealue(nimi) VALUES ('Yleistä');
INSERT INTO Keskustelu(keskustelu_id, kayttaja_id, otsikko) VALUES (1,1,'Yleinen keskustelu');
INSERT INTO Viesti(kayttaja_id, sisalto) VALUES (1,'Random message');