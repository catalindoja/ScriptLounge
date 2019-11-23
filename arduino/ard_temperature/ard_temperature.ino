#include <ArduinoLowPower.h>
#include <DHT.h>
#include <SigFox.h> 
 
#define DHTPIN 2
#define LECTURES 6
#define TIME_BETWEEN_MESURES 10000 //ms
#define DHTTYPE DHT11

#define DEBUG true

DHT dht(DHTPIN, DHTTYPE);

class SigFoxMessage {
  public:
    int8_t temps[6];
    int8_t humid[6];
};

void setup() {
  //Conf serial display/monitor and time to open monitor
  Serial.begin(9600);
  while (!Serial) {}
  dht.begin();
  
  // Init module
  if(!SigFox.begin()){
    Serial.println("Error al iniciar módulo Sigfox");
    return;
  }
  if (DEBUG) {
  // Mostramos la información del ID y de PAC
    Serial.println("ID = " + SigFox.ID());
    Serial.println("PAC = " + SigFox.PAC());
  }
 
  // Stop module
  SigFox.end();
  LowPower.attachInterruptWakeup(RTC_ALARM_WAKEUP, alarmEvent, CHANGE);
}
 
void loop() {
    SigFoxMessage msg;
    
    for (int i = 0; i<LECTURES; i++) {
        float t = dht.readTemperature();
        msg.temps[i]  = (int8_t) t;
        float h = dht.readHumidity();
        msg.humid[i]  = (int8_t) h;
        if (DEBUG) Serial.println("Captured lecture number "+String(i+1) + "\tT: "+ String(msg.temps[i])+
                                  "\tH: "+String(msg.humid[i])+"\tBytes: "+  String(sizeof(msg.temps[i])+ sizeof(msg.humid[i])) );
        LowPower.sleep(TIME_BETWEEN_MESURES); 
    }
    Serial.println(sizeof(msg));
    if (sizeof(msg) > 12) Serial.println("Too many data, only first 12 bytes will be sent");
    //Init module, 0,5 ms to wait sync.
    /*SigFox.begin();
    delay(500);

    //Init transmit. 12 bytes of message
    SigFox.beginPacket();
    SigFox.write( (uint8_t*)&msg, sizeof(msg));
    
    // send buffer to SIGFOX network
    if (DEBUG) {
      switch(SigFox.endPacket()) {
        case 0: Serial.println("Transmission ok"); break;
        default: Serial.println("No transmission"); break;
      }
    }
    SigFox.end();*/
    Serial.flush();
}
void alarmEvent() {
  if (DEBUG) Serial.println("Waking up. Starting reading...");
}
