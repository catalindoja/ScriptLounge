#include <ArduinoLowPower.h>
#include <DHT.h>
#include <SigFox.h>
 
#define DHTPIN 2
#define DHTTYPE DHT11

DHT dht(DHTPIN, DHTTYPE);
 
void setup() {
  // Configuración del monitor serie
  Serial.begin(9600);
  dht.begin();
  // Iniciamos módulo Sigfox
  if(!SigFox.begin()){
    Serial.println("Error al iniciar módulo Sigfox");
    return;
  }
 
  // Mostramos la información del ID y de PAC
  Serial.println("ID = " + SigFox.ID());
  Serial.println("PAC = " + SigFox.PAC());
 
  // Apagamos el módulo
  SigFox.end();
}
 
void loop() {
  float t = dht.readTemperature();
  //msg.t = convertoFloatToInt16(t, 60, -60);
  float h = dht.readHumidity();
  //msg.h = convertoFloatToUInt16(h, 110);
  Serial.println("T: "+String(t)+"\tH: "+String(h));
  delay(5000);


//msg.moduleTemperature = convertoFloatToInt16(temperature, 60, -60);
//SigFox.write((uint8_t*)&msg, 12);
}
