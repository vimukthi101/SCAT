#include <SPI.h>
#include <MFRC522.h>
#define RST_PIN   5
#define SS_PIN    53

MFRC522 mfrc522(SS_PIN, RST_PIN);
MFRC522::MIFARE_Key key;//create a MIFARE_Key struct named 'key', which will hold the card information

int block=2;//this is the block number we will write into and then read. Do not write into 'sector trailer' block, since this can make the block unusable.
byte blockcontent[17] = {"1234567890123455"};//an array with 16 bytes to be written into one of the 64 card blocks is defined
byte readbackblock[19];//This array is used for reading out a block. The MIFARE_Read method requires a buffer that is at least 18 bytes to hold the 16 bytes of a block.

void setup() {
    Serial.begin(9600);  
    while (!Serial);     
    SPI.begin();         
    mfrc522.PCD_Init(); 
    Serial.println(F("Scan a MIFARE Classic card"));
    for (byte i = 0; i < 6; i++) {
          key.keyByte[i] = 0xFF;
    }
}

void loop()
{ 
    if ( ! mfrc522.PICC_IsNewCardPresent() || ! mfrc522.PICC_ReadCardSerial() ) {
      delay(50);
      return;
    }
    
    Serial.println(F("card selected"));
    
    writeBlock(block, blockcontent);
    
    readBlock(block, readbackblock);
    Serial.print(F("read block: "));
    for (int j=0 ; j<16 ; j++)
    {
      Serial.write (readbackblock[j]);
    }
    Serial.println();
}


