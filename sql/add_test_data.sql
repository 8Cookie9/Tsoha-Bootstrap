-- Lisää INSERT INTO lauseet tähän tiedostoon
INSERT INTO Kayttaja(nimi, admin) VALUES ('user1',false);
INSERT INTO Kayttaja(nimi, admin) VALUES ('user2',false);
INSERT INTO Kayttaja(nimi, admin) VALUES ('admin',true);
INSERT INTO Aihealue(nimi) VALUES ('Yleistä');
INSERT INTO Aihealue(nimi) VALUES ('Harrastukset');
INSERT INTO Keskustelu(aihealue_id, kayttaja_id, otsikko) VALUES (1,1,'Yleinen keskustelu');
INSERT INTO Viesti(keskustelu_id, kayttaja_id, sisalto) VALUES (1, 1,'Random message');