#include <ArduinoLowPower.h>
#include <DHT.h>
#include <SigFox.h>
 
#define DHTPIN 2
#define BYTES_DATA 12
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
  byte sendBytes[BYTES_DATA] = {};
  for (int i = 0; i<BYTES_DATA/2; i++) {
      float t = dht.readTemperature();
      sendBytes[i*2]   = (byte) t;
      float h = dht.readHumidity();
      sendBytes[i*2+1] = (byte) h;
      Serial.println("Captured lecture number "+String(i));
      delay(5000);
  }
  Serial.println(String(sizeof(sendBytes)));
  Serial.println("T1: "+ String(sendBytes[0])  + "\tH1: "+String(sendBytes[1])+
               "\t\tT2: "+ String(sendBytes[2])  + "\tH2: "+String(sendBytes[3])+
               "\t\tT3: "+ String(sendBytes[4])  + "\tH3: "+String(sendBytes[5])+
               "\t\tT4: "+ String(sendBytes[6])  + "\tH4: "+String(sendBytes[7])+
               "\t\tT5: "+ String(sendBytes[8])  + "\tH5: "+String(sendBytes[9])+
               "\t\tT6: "+ String(sendBytes[10]) + "\tH6: "+String(sendBytes[11])
               );

    if (sizeof(sendBytes) > 12) {
        Serial.println("Too many data, only first 12 bytes will be sent");
    }
//msg.moduleTemperature = convertoFloatToInt16(temperature, 60, -60);
//SigFox.write((uint8_t*)&msg, 12);
}
