drop database if exists Arhimed;
create database Arhimed default character set utf8;
use Arhimed;

create table polaznik(
polaznik_id 	int not null primary key auto_increment,
ime 			varchar(50) not null,
prezime 		varchar(50) not null,
oib 			int(11) not null,
predmet 		varchar (50),
kor_ime 		varchar (7),
lozinka 		char(7),
cijena 			decimal(18,2)
);

create table razina(
razina_id 	int not null primary key auto_increment,
obrazovanje		varchar(50)
);

create table predmet(
predmet_id 		int not null primary key auto_increment,
naziv 			varchar(50) not null,
razina_id 		int not null,
trajanje 		int not null,
predavac_id 	int not null
);

create table polaznik_predmet(
polaznik_predmet_id 	int not null primary key auto_increment,
polaznik_id 			int not null,
predmet_id 				int not null,
cijenap_p				decimal(10,2)
);

create table predavac(
predavac_id 	int not null primary key auto_increment,
ime 			varchar(50) not null,
prezime 		varchar(50) not null,
oib 			int(11) not null,
ziro_racun 		varchar(50) not null
);

create table termin(
termin_id 			int not null primary key auto_increment,
predmet_id 			int not null,
predavac_id 		int not null,
dvorana_id 			int not null,
polaznik_predmet_id int not null,
pocetak				datetime not null,
zavrsetak			datetime not null,
popunjenost			decimal(4,2),
upis_do				datetime not null
);					

create table predmet_termin(
predmet_termin_id 		int not null primary key auto_increment,
termin_id 				int not null,
polaznik_predmet_id 	int not null,
prisutan 				varchar(10),
otkazao					varchar(10)
);

create table dvorana(
dvorana_id		int not null primary key auto_increment,
naziv_dvorane	varchar(10),
kapacitet		int
);

alter table polaznik_predmet add foreign key (polaznik_id) references polaznik(polaznik_id);
alter table polaznik_predmet add foreign key (predmet_id) references predmet(predmet_id);

alter table termin add foreign key (predavac_id) references predavac(predavac_id);
alter table termin add foreign key (predmet_id) references predmet(predmet_id);
alter table termin add foreign key (dvorana_id) references dvorana(dvorana_id);
alter table termin add foreign key (polaznik_predmet_id) references polaznik_predmet(polaznik_predmet_id);

alter table predmet add foreign key (predavac_id) references predavac(predavac_id);
alter table predmet add foreign key (razina_id) references razina(razina_id);

alter table predmet_termin add foreign key (termin_id) references termin(termin_id);
alter table predmet_termin add foreign key (polaznik_predmet_id) references polaznik_predmet(polaznik_predmet_id);


/*SELECT SUBSTRING(MD5(RAND()) FROM 1 FOR 7) AS lozinka;

select concat(substring('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789', rand()*36+1, 1),
              substring('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789', rand()*36+1, 1),
              substring('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789', rand()*36+1, 1),
              substring('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789', rand()*36+1, 1),
              substring('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789', rand()*36+1, 1),
              substring('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789', rand()*36+1, 1),
              substring('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789', rand()*36+1, 1),
              substring('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789', rand()*36+1, 1)
             ) as kor_ime;*/

select * from razina;

insert into razina(obrazovanje)
values
('osnovna škola'),
('srednja škola'),
('građevinski faluktet'),
('elektrotehnički faluktet');

update razina set obrazovanje='Građevinski fakultet' where razina_id=3;
update razina set obrazovanje='Elektrotehnički fakultet' where razina_id=4;
update razina set obrazovanje='Osnovna škola' where razina_id=1;
update razina set obrazovanje='Srednja škola' where razina_id=2;

select*from predavac;

alter table predavac auto_increment=1;

alter table predavac change oib oib char(11) not null;

insert into predavac(ime,prezime,oib,ziro_racun)
values
('Marko','Đuroković','12365469856','HR445698564659'),
('Josip','Crnojevac','54684574562','HR405256484521'),
('Ivona','Franjkić','32545865897','HR390412568459');

update table predavac set oib='12365469856' where predavac_id=1;
update table predavac set oib='54684574562' where predavac_id=2;
update table predavac set oib='32545865897' where predavac_id=3;

delete from predavac where predavac_id=12;

select * from predmet;

insert into predmet (naziv, razina_id, trajanje,predavac_id)
values
('Matematika', 1, '30', 1),
('Fizika', 1, '35', 1),
('Matematika', 2, '50', 1),
('Fizika', 2, '55', 1),
('Matematička statistika', 3, '40', 2),
('Matematička statistika', 4, '45', 3);

select b.naziv, c.obrazovanje
from predavac a
inner join predmet b on b.predavac_id=a.predavac_id
inner join razina c on c.razina_id=b.razina_id
where a.ime='Marko' and a.prezime='Đuroković';