#drop database if exists arhimed_db;
#create database arhimed_db default character set utf8;
#use arhimed_db;

alter database default character set utf8;

create table polaznik(
polaznik_id 	int not null primary key auto_increment,
uloga			varchar(50) not null,
ime 			varchar(50) not null,
prezime 		varchar(50) not null,
oib 			bigint (11)	not null,
email 			varchar (50) not null,
lozinka 		char(7)  not null,
iznos 			decimal(18,2) not null default 0.00
);

create table razina(
razina_id 	int not null primary key auto_increment,
obrazovanje		varchar(50) not null
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
cijenap_p				decimal(10,2) not null
);

create table predavac(
predavac_id 	int not null primary key auto_increment,
uloga			varchar(50) not null,
ime 			varchar(50) not null,
prezime 		varchar(50) not null,
oib 			bigint(11) not null,
email 			varchar (50),
lozinka			char (32) not null,
ziro_racun 		varchar(50) not null
);

create table termin(
termin_id 			int not null primary key auto_increment,
predavac_id 		int not null,
dvorana_id 			int not null,
pocetak				datetime not null,
zavrsetak			datetime,
popunjenost			decimal(4,2) default '0.00',
prijava_do		    datetime not null
);					

create table predmet_termin(
predmet_termin_id 		int not null primary key auto_increment,
termin_id 				int not null,
polaznik_predmet_id 	int not null,
prisutan 				bit default 1,
otkazao					bit default 0
);

create table dvorana(
dvorana_id		int not null primary key auto_increment,
naziv_dvorane	varchar(10),
kapacitet		int (5)
);

create table osoba(
osoba_id 	int not null primary key auto_increment,
uloga		varchar(50) not null,
ime 		varchar(50) not null,
prezime     varchar(50) not null,
email 		varchar (50) not null,
lozinka		char (32) not null
);

alter table polaznik_predmet add foreign key (polaznik_id) references polaznik(polaznik_id);
alter table polaznik_predmet add foreign key (predmet_id) references predmet(predmet_id);

alter table termin add foreign key (predavac_id) references predavac(predavac_id);
alter table termin add foreign key (dvorana_id) references dvorana(dvorana_id);

alter table predmet add foreign key (predavac_id) references predavac(predavac_id);
alter table predmet add foreign key (razina_id) references razina(razina_id);

alter table predmet_termin add foreign key (termin_id) references termin(termin_id);
alter table predmet_termin add foreign key (polaznik_predmet_id) references polaznik_predmet(polaznik_predmet_id);

create unique index ix1 on polaznik(oib);

insert into osoba (uloga,ime,prezime,email,lozinka)
values
('admin','Ivan','Perić','i.peric3@gmail.com',md5('ip')),
('predavac','Marko','Đuroković','marko@etfos.hr',md5('m')),
('polaznik','Milan','Begović','milan.begovic@gmail.com',md5('m')),
('polaznik','Eugen','Kumičić','pisac1870@gmail.com',md5('e')),
('polaznik','August','Šenoa','senoa.a@net.hr',md5('a')),
('predavac','Ivona','Franjkić','i.franjkic@etfos.hr',md5('i')
);

insert into predavac(uloga,ime,prezime,oib,email,lozinka,ziro_racun)
values
('predavac','Marko','Đuroković','12365469856','iperic@etfos.hr',md5('m'),'HR445698564659'),
('predavac','Josip','Crnojevac','57456254584','joza@net.hr',md5('j'),'HR405256484521'),
('predavac','Ivona','Franjkić','32545865897','i.franjkic@etfos.hr',md5('i'),'HR390412568459');

insert into razina(obrazovanje)
values
('Osnovna škola'),
('Srednja škola'),
('Građevinski fakultet'),
('Elektrotehnički fakultet');

insert into predmet (naziv, razina_id, trajanje,predavac_id)
values
('Matematika', 1, '30', 1),
('Fizika', 1, '35', 1),
('Matematika', 2, '50', 1),
('Fizika', 2, '55', 1),
('Matematička statistika', 3, '40', 2),
('Matematička statistika', 4, '45', 3);

insert into polaznik(uloga,ime,prezime,oib,email,lozinka)
values
('polaznik','Ivo','Kozarčanin','32456985641','ikoz@hotmail.com',md5('i')),
('polaznik','Ante','Kovačić','21235698754','akovacic56@gmail.com',md5('a')),
('polaznik','Janko','Leskovar','12547856985','jankol@yahoo.com',md5('j')),
('polaznik','Vjekoslav','Mayer','14256897512','vmayer4@net.hr',md5('v')),
('polaznik','Milan','Begović','45875245698','milan.begovic@gmail.com',md5('m')),
('polaznik','Eugen','Kumičić','85695475326','pisac1870@gmail.com',md5('e')),
('polaznik','August','Šenoa','14585698532','senoa.a@net.hr',md5('a')),
('polaznik','Josip','Tomić','12536547895','joza.toma@hotmail.com',md5('j'));

insert into dvorana(naziv_dvorane,kapacitet)
values
('D1',20),
('D2',10);

insert into termin(predavac_id,dvorana_id,pocetak)
values
('3','2','2017-10-21 16:00:00'),
('1','2','2017-10-22 10:00:00'),
('2','1','2017-10-23 15:00:00');

insert into polaznik_predmet(polaznik_id, predmet_id, cijenap_p)
values
('8','6','45.00'),
('7','5','45.00'),
('6','4','50.00'),
('5','3','35.00'),
('4','2','35.00'),
('3','2','50.00'),
('2','6','25.00'),
('1','1','25.00');

insert into predmet_termin(termin_id,polaznik_predmet_id,prisutan,otkazao)
values
('1','1','',''),
('3','2','',''),
('2','4','','');