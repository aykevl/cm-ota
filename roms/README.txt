Set up OTA updates by creating these files for every update:

  * ROM.zip
  * ROM.zip.md5sum
  * ROM.txt

Where ROM should be replaced with your ROM name, for example
cm-13.0-20160630-UNOFFICIAL-kminilte (making
cm-13.0-20160630-UNOFFICIAL-kminilte.zip). The .zip file contains the ROM
itself, the first 32 bytes of .zip.md5sum contain the hexadecimal MD5 sum of the
.zip (other contents will be ignored), and the .txt contains a changelog.
