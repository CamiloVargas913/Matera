#include <SoftwareSerial.h>
SoftwareSerial BT1(3, 2); // RX |TX
#define sensorSuelo A0
#define sensorLuz A1
#define bombaAgua 13
#define id 1
const String urlTweet="apps/thingtweet/1/statuses/update?api_key=";
const String servidorTweet="api.thingspeak.com";
const char* api="38V0IU6SAISXM6T7";
const char* mensaje1="Necesito agua, mi humedad es: ";
const char* mensaje2="Estoy hidratada :), mi humdedad es: ";
const char* mensaje3="Necesito mas luz, mi luz es: ";
const char* mensaje4="Es un hermoso dia :), mi luz es: ";
const char* mensaje5="Es un muy soleado :/, mi luz es: ";
const char* mensaje6="Tengo demaciada humedad :/, mi humedad es: ";
const char* acceso=" revisa mi estado en: www.wencapp.com/Matera/index.php";
const String server="www.wencapp.com";
const String cadena="";
void setup() {
  pinMode(bombaAgua, OUTPUT);
    Serial.begin(9600);
    BT1.begin(9600);
    BT1.setTimeout(2000);
}

void loop() {
  sensores();
}

void sensores(){
  //----------------Datos de Humedad--------------
  int senHumedad = analogRead(sensorSuelo);
   int porcentajeHumedad = map(senHumedad,1024,112,0,100); 
     //---------------------Datos Luz--------------------------
    int senLuz = analogRead(sensorLuz);
    int porcentajeLuz = map(senLuz,0,1024,100,0);
    if(porcentajeLuz<30){
     enviarTweet(mensaje3,porcentajeLuz);
   }else if(porcentajeLuz>30 && porcentajeLuz<80){
      enviarTweet(mensaje4,porcentajeLuz);
   }else{
     enviarTweet(mensaje5,porcentajeLuz);
   }
   if(porcentajeHumedad<33){
      enviarTweet(mensaje1,porcentajeHumedad);
      regado(porcentajeHumedad);
    }else if(porcentajeHumedad>33 && porcentajeHumedad<80){
      enviarTweet(mensaje2,porcentajeHumedad);
    }else{
        enviarTweet(mensaje6,porcentajeHumedad);
    }
     enviarServidor(porcentajeHumedad,porcentajeLuz);
}
void conexionAt(){
  //conexion con ESP82666
  BT1.println("AT");
  BT1.setTimeout(2000);
  if(BT1.find("OK")){
    Serial.println(F("AT Correcto"));
  }else{
    Serial.println(F("Error AT"));
  }
  BT1.println("AT+CWMODE=1");
  BT1.setTimeout(2000);
  if(BT1.find("OK")){
    Serial.println(F("CWMODE Correcto"));
  }else{
    Serial.println(F("Error CWMODE"));
  }

  BT1.println(F("AT+CWJAP=\"FamiliaVargasQuintero\",\"CamiloVargas1222\""));
  BT1.setTimeout(10000);
  if(BT1.find("OK")){
    Serial.println(F("el wifi quedo full"));
  }else{
    Serial.println(F("Error Conexion wifi"));
  }
}
////////////////////////////////////////////////////////////////////////////////////
void enviarTweet(String cad,int estado){
  conexionAt();
    BT1.println("AT+CIPMODE=0");
  if(BT1.find("OK")){
    Serial.println(F("CIPMODE Correcto"));
  }else{
    Serial.println(F("Error CIPMODE"));
  }
  BT1.println("AT+CIPMUX=1");
  BT1.setTimeout(2000);
  if(BT1.find("OK")){
    Serial.println(F("CIPMUX Correcto"));
  }else{
    Serial.println(F("Error CIPMUX"));
  } 
  ////////////////////////////////////////////////////////////////////
     BT1.println("AT+CIPSTART=0,\"TCP\",\"" + servidorTweet + "\",80");
    if(BT1.find("OK")){
          Serial.println();
          Serial.println();
          Serial.println();
          Serial.println(F("Conectado con el twitter"));
   
      String servidor="GET /"+(urlTweet)+(api)+"&status="+(cad)+String(estado)+acceso+"\r\n";

          BT1.print("AT+CIPSEND=0,");
          BT1.println(servidor.length());

            if(BT1.find(">")){
              Serial.println(F("Enviando a twitter...."));
              BT1.println(servidor);
              if(BT1.find("SEND OK")){
                Serial.println(F("twitter enviado:"));
                Serial.println();
                Serial.println(servidor);
                Serial.println(F("Esperando respuesta..."));

              boolean respuesta=false;
             unsigned long timeInicio=millis();  
              cadena="";
              while(respuesta==false){
                while(BT1.available()>0){
                  char t=BT1.read();
                  Serial.write(t);
                  cadena.concat(t);
                  //Serial.println(cadena);
                }
                if((millis()-timeInicio)>20000){
                  Serial.println(F("Se agoto el tiempo de espera"));
                  BT1.println("AT+CIPCLOSE");
                  if(BT1.find("OK")){
                    Serial.println(F("Conexion Finalizada"));
                    respuesta=true;
                } 
              }
              
              if(cadena.indexOf("CLOSED")>-1){
                Serial.println(F("Cadena recibida correctamente, conexion finalizada"));
                respuesta=true;  
              }
             }
            }else{
              Serial.println(F("No se a podido enviar twitter"));
            }
          }
    }else{
      Serial.println(F("No se pudo conectar con twitter"));
    }
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
void enviarServidor(int H,int L){
  conexionAt();
    BT1.println("AT+CIPMUX=0");
  BT1.setTimeout(2000);
  if(BT1.find("OK")){
    Serial.println(F("CIPMUX Correcto"));
  }else{
    Serial.println(F("Error CIPMUX"));
  }
  //----------enviar a servidor-------
   BT1.println("AT+CIPSTART=\"TCP\",\"" + server + "\",80");
    if(BT1.find("OK")){
          Serial.println();
          Serial.println();
          Serial.println();
          Serial.println(F("Conectado con el servidor..."));
   
      String servidor="GET /Matera/matera1.php?a=";
      servidor=servidor+String(id)+"&b="+String(L)+"&c="+String(H)+" HTTP/1.1\r\n";
      servidor=servidor+"Host: "+server+"\r\n\r\n";   

          BT1.print("AT+CIPSEND=");
          BT1.println(servidor.length());

            if(BT1.find(">")){
              Serial.println(F("Enviando HTTP...."));
              BT1.println(servidor);
              if(BT1.find("SEND OK")){
                Serial.println(F("Peticion HTTP enviada:"));
                Serial.println();
                Serial.println(servidor);
                Serial.println(F("Esperando respuesta..."));

              boolean respuesta=false;
             unsigned long timeInicio=millis();  
              cadena="";
              while(respuesta==false){
                while(BT1.available()>0){
                  char t=BT1.read();
                  Serial.write(t);
                  cadena.concat(t);
                }
                if((millis()-timeInicio)>20000){
                  Serial.println(F("Se agoto el tiempo de espera"));
                  BT1.println("AT+CIPCLOSE");
                  if(BT1.find("OK")){
                    Serial.println(F("Conexion Finalizada"));
                    respuesta=true;
                } 
              }
              
              if(cadena.indexOf("CLOSED")>-1){
                Serial.println(F("Cadena recibida correctamente, conexion finalizada"));
                respuesta=true;
              }
             }
            }else{
              Serial.println(F("No se a podido enviar Http al servidor"));
            }
          }
    }else{
      Serial.println(F("No se pudo conectar con el servidor"));
    }
    /////////////////////////////******************************///////////////
    
    delay(6000);// tiempo de espera para  volver a enviar datos
}

void regado(int humedad){
        digitalWrite(bombaAgua, HIGH);
        Serial.println(F("Regando..."));
        delay(6000);      
        digitalWrite(bombaAgua, LOW);
   }