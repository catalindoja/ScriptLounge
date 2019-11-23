CREATE DATABASE scriptlounge;
USE scriptlounge;
CREATE TABLE Mesura (
	idDevice CHAR(6) NOT NULL,
	Temps DATETIME NOT NULL,
	PRIMARY KEY (idDevice, Temps)
);

CREATE TABLE Temperatura (
	idDevice CHAR(6) NOT NULL,
	Temps DATETIME,
	idTemperatura INT NOT NULL,
	valor INT NOT NULL,
	PRIMARY KEY (idDevice,idTemperatura),
	FOREIGN KEY (idDevice, Temps) REFERENCES Mesura(idDevice,Temps)
);


CREATE TABLE Humitat(
	idDevice CHAR(6) NOT NULL,
	Temps DATETIME,
	idHumitat INT NOT NULL,
	valor INT NOT NULL,
	PRIMARY KEY (idDevice,idHumitat),
	FOREIGN KEY (idDevice,Temps) REFERENCES Mesura(idDevice,Temps)
);
