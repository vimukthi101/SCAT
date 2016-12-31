#include <SPI.h>
#include <Ethernet.h>
#include <MFRC522.h>
#define RST_PIN   5
#define SS_PIN    53

/******************** ETHERNET SETTINGS ********************/

byte mac[] = { 0x90, 0xA2, 0xDA, 0x0D, 0x85, 0xD9 };   //physical mac address
byte subnet[] = { 255, 255, 255, 0 };              //subnet mask
byte gateway[] = { 192, 168, 0, 1 };              // default gateway

/*change following*/
byte ip[] = { 192, 168, 1, 120 };                   // ip for shield
IPAddress server(192,168,1,4);                      // ip of lap

EthernetClient client;
String data, cardNumber;

/******************** RFID SETTINGS ********************/

MFRC522 mfrc522(SS_PIN, RST_PIN);
MFRC522::MIFARE_Key key;//create a MIFARE_Key struct named 'key', which will hold the card information

int block=2;//this is the block number we will write into and then read. Do not write into 'sector trailer' block, since this can make the block unusable.
byte readbackblock[19];//This array is used for reading out a block. The MIFARE_Read method requires a buffer that is at least 18 bytes to hold the 16 bytes of a block.

void setup() {
    Serial.begin(9600);  // Initialize serial communications with the PC
    while (!Serial);     // Do nothing if no serial port is opened (added for Arduinos based on ATMEGA32U4)
    Ethernet.begin(mac,ip);     // initialize Ethernet device
    Serial.print("My IP address: ");
    for (byte thisByte = 0; thisByte < 4; thisByte++) {
      Serial.print(Ethernet.localIP()[thisByte], DEC);
      Serial.print(".");
    }
    Serial.println();
    Serial.println("connecting....");
    data = "";
    cardNumber = "";
    SPI.begin();         // Init SPI bus
    mfrc522.PCD_Init();  // Init MFRC522 card
    Serial.println(F("Reading the card ID..."));
    for (byte i = 0; i < 6; i++) {
            key.keyByte[i] = 0xFF;//keyByte is defined in the "MIFARE_Key" 'struct' definition in the .h file of the library
    }
}

void loop()
{     
    // Look for new cards, and select one if present
    if ( ! mfrc522.PICC_IsNewCardPresent() || ! mfrc522.PICC_ReadCardSerial() ) {
      delay(50);
      return;
    }
         
    Serial.println(F("card selected"));
    
    readBlock(block, readbackblock);//read the block back
    Serial.print(F("read block: "));
    for (int j=0 ; j<16 ; j++)//print the block contents
    {
      Serial.write (readbackblock[j]);//Serial.write() transmits the ASCII numbers as human readable characters to serial monitor
      cardNumber += (char)readbackblock[j];
    }
    data = "temp1="+cardNumber+"&hum1=20";
    Serial.println();
    sendRequest();
    if (client.connected()) {
      char c = client.read();                           // read the answer of the server and
      Serial.write(c);  
      Serial.println();
      client.stop();// DISCONNECT FROM THE SERVER
      Serial.println("disconnected");
    }
    Serial.println();
    Serial.println();
}

void sendRequest(){
  if (client.connect(server,1234)) { // REPLACE WITH YOUR SERVER ADDRESS
      Serial.println("connected");
      client.println("POST /add.php HTTP/1.1"); 
      Serial.println("POST /add.php HTTP/1.1"); 
      client.println("Host: localhost"); // SERVER ADDRESS HERE TOO
      Serial.println("Host: localhost");
      client.println("Content-Type: application/x-www-form-urlencoded"); 
      Serial.println("Content-Type: application/x-www-form-urlencoded"); 
      client.print("Content-Length: "); 
      Serial.print("Content-Length: ");
      client.println(data.length()); 
      Serial.println(data.length()); 
      client.println(); 
      Serial.println(); 
      client.print(data); 
      Serial.print(data); 
      Serial.println();
      char c = client.read();                           // read the answer of the server and
      Serial.write(c);  
      Serial.println();
    } else {
      Serial.println("connection failure");
      sendRequest();
    }
}


