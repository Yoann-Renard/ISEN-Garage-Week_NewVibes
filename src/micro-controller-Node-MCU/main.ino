int bouton = 4;
int ledPin = 2;


#include <LiquidCrystal.h>
#include <LiquidCrystal_I2C.h>
int lcdColumns = 16;
int lcdRows = 3;

static int i=0;
LiquidCrystal_I2C lcd(0x27, lcdColumns, lcdRows);  

const byte PIN_ENABLE = 15;
const byte PIN_ADDR_A = 14;
const byte PIN_ADDR_B =12;
const byte PIN_ADDR_C = 13;

// Broche de signal
const byte PIN_SIG = A0;


#ifdef ESP32
  #include <WiFi.h>
  #include <HTTPClient.h>
#else
  #include <ESP8266WiFi.h>
  #include <ESP8266HTTPClient.h>
  #include <WiFiClient.h>
#endif

#include <Wire.h>
#include <Adafruit_Sensor.h>
#include <Adafruit_BME280.h>

// Replace with your network credentials
const char* ssid     = "netWorkName";
const char* password = "netWorkPass";

// REPLACE with your Domain name and URL path or IP address with path
const char* serverName = "http://servername/NewVibe/App/post_db/post-esp-data.php";

// Keep this API Key value to be compatible with the PHP code provided in the project page. 
// If you change the apiKeyValue value, the PHP file /post-esp-data.php also needs to have the same key 
String apiKeyValue = "NewVibe"; 

#define SEALEVELPRESSURE_HPA (1013.25)

Adafruit_BME280 bme;  // I2C
int tampon=0;

  int energie_batterie; 
 int energie_conso_maison1=0;
int energie_conso_maison2=0;


   
    HTTPClient http;
    HTTPClient http2;
    HTTPClient http3;
    WiFiClient client;
    
void setup() {
 
  Serial.begin(115200);

WiFi.begin(ssid, password);
  Serial.println("Connecting");
  while(WiFi.status() != WL_CONNECTED) { 
    delay(500);
    Serial.print(".");
  }
  Serial.println("");
  Serial.print("Connected to WiFi network with IP Address: ");
  Serial.println(WiFi.localIP());
// Place les broches d'adresse en sortie et à LOW
  pinMode(PIN_ADDR_A, OUTPUT);
  pinMode(PIN_ADDR_B, OUTPUT); 
  pinMode(PIN_ADDR_C, OUTPUT); 
  digitalWrite(PIN_ADDR_A, LOW);
  digitalWrite(PIN_ADDR_B, LOW);
  digitalWrite(PIN_ADDR_C, LOW);
  
  // Active le CD4051B
  pinMode(PIN_ENABLE, OUTPUT);
  digitalWrite(PIN_ENABLE, LOW);

   pinMode(bouton,INPUT);  

  
    // initialize LCD
  lcd.init();
  // turn on LCD backlight                      
  lcd.backlight();
 
  
  pinMode(ledPin, OUTPUT);
 digitalWrite(ledPin, LOW);
 // Your Domain name with URL path or IP address with path
    http.begin(client,serverName);
    http2.begin(client,serverName);
    http3.begin(client,serverName);
    HTTPClient http;
    HTTPClient http2;
    HTTPClient http3;
    WiFiClient client;
    // Your Domain name with URL path or IP address with path
    http.begin(client,serverName);
    http2.begin(client,serverName);
    http3.begin(client,serverName);

}

void loop() {
  Serial.println(tampon);
   
 if (tampon==0 && digitalRead(bouton) == HIGH){
     tampon = 1;
     
    Serial.println("vous avez appuye sur le bouton");
    //Serial.println(tampon);

  }
  
  else if(digitalRead(bouton)==HIGH && tampon==1){
    Serial.println("vous avez appuye sur le bouton");
  tampon=0;
  //Serial.println(tampon);
  }
  

  
    // Pour chaque voie on renvoie la valeur sur le port série
  for(byte i = 0; i < 8; i++){
    Serial.print("Voie ");
    Serial.print(i);
    Serial.print(" : ");
    Serial.println(readAnalogMux(i));
  }
  

   int soleilStatus = readAnalogMux(1);
   int moteurStatus = readAnalogMux(3);
   Serial.println("somme des energies1 :");
   int somme= ((moteurStatus*5)/500)*2.5 + ((soleilStatus*5)/500)*2.5 ;
   Serial.println(somme);
   Serial.println("somme energie maison2");
   int somme2= ((readAnalogMux(7)*5)/500)*2.5 ;
   Serial.println(somme2);
   Serial.println(energie_batterie);
   energie_batterie = energie_batterie + somme + somme2 ;
   Serial.println("somme des energies totales cumulée :");
  Serial.println(energie_batterie);
   
  if(tampon==1 && energie_batterie>100)
  {  
      int nbrAleatoire = random(30);
  energie_conso_maison1 = 6 + nbrAleatoire ;
 int nbrAleatoire2 = random(30);
   energie_conso_maison2 = 6 + nbrAleatoire2 ;
    energie_batterie=energie_batterie - energie_conso_maison1;

    digitalWrite(ledPin,HIGH);
    lcd.print("Led 1 allumee");
  }
  
  else {
    Serial.println("OFF"); 
  digitalWrite(ledPin,LOW);
  energie_conso_maison1 =0;
  energie_conso_maison2=0;
  }
  

  
  if(WiFi.status()== WL_CONNECTED){
    
    // Specify content-type header
    http.addHeader("Content-Type", "application/x-www-form-urlencoded");
    http2.addHeader("Content-Type", "application/x-www-form-urlencoded");
    http3.addHeader("Content-Type", "application/x-www-form-urlencoded");
    // Prepare your HTTP POST request data
    String httpRequestData = "api_key=" + apiKeyValue + "&prod=" + somme + "&id_maison=" + 1 + "&conso=" + energie_conso_maison1; 
    String httpRequestData2 = "api_key=" + apiKeyValue + "&prod=" + somme2 + "&id_maison=" + 2 + "&conso=" + energie_conso_maison2;
    String httpRequestData3 = "api_key=" + apiKeyValue + "&batterie=" + energie_batterie + "&id=" + i ;
    Serial.print("httpRequestData: ");
    Serial.println(httpRequestData);
    Serial.print("httpRequestData2: ");
    Serial.println(httpRequestData2);
    Serial.print("httpRequestData3: ");
    Serial.println(httpRequestData3);
    int httpResponseCode = http.POST(httpRequestData);
    delay(200);
    int httpResponseCode2 = http2.POST(httpRequestData2);
    delay(200);
    int httpResponseCode3 = http3.POST(httpRequestData3);
    delay(200);
   
    if (httpResponseCode>0) {
          Serial.print("HTTP Response code: ");
          Serial.println(httpResponseCode);
        }
        else {
          Serial.print("Error code: ");
          Serial.println(httpResponseCode);
        }
        if (httpResponseCode2>0) {
          Serial.print("HTTP Response code: ");
          Serial.println(httpResponseCode2);
        }
        else {
          Serial.print("Error code: ");
          Serial.println(httpResponseCode2);
        }
          if (httpResponseCode3>0) {
          Serial.print("HTTP Response code: ");
          Serial.println(httpResponseCode3);
        }
        else {
          Serial.print("Error code: ");
          Serial.println(httpResponseCode3);
        }
        // Free resources
        //http.end();
        //http2.end();
        //http3.end();
      }
      else {
        Serial.println("WiFi Disconnected");
      }
      delay(10000);
    
}


int readAnalogMux(byte channel) {
  
  // On sélectionne la voie
  digitalWrite(PIN_ADDR_A, bitRead(channel, 0));
  digitalWrite(PIN_ADDR_B, bitRead(channel, 1));
  digitalWrite(PIN_ADDR_C, bitRead(channel, 2));
 
  // On lit la valeur courante
  return analogRead(PIN_SIG);
}
