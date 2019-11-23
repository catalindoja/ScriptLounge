CREATE DATABASE scriptlounge;
USE scriptlounge;
CREATE TABLE Mesura (
	idDevice CHAR(6) NOT NULL,
	Temps DATETIME NOT NULL,
	PRIMARY KEY (idDevice)
);

CREATE TABLE Temperatura (
	idDevice CHAR(6) NOT NULL,
	idTemperatura INT NOT NULL,
	valor INT NOT NULL,
	PRIMARY KEY (idDevice,idTemperatura),
	FOREIGN KEY (idDevice) REFERENCES Mesura(idDevice)
);


CREATE TABLE Humitat(
	idDevice CHAR(6) NOT NULL,
	idHumitat INT NOT NULL,
	valor INT NOT NULL,
	PRIMARY KEY (idDevice,idHumitat),
	FOREIGN KEY (idDevice) REFERENCES Mesura(idDevice)
);
