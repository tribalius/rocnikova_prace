<?php

class db {
    /**
     * @var ve které je uložené spojení 
     */
    private static $pripojeni;
    
    
   /**
     * @param string host host name nebo IP adresa
     * @param string name prihlasovaci jmeno
     * @param string heslo prihlasovaci heslo
     * @param string databaze jmeno databaze ke ktere se pripojujeme
     * @return do $pripojeni se ulozi pripojeni k databazi a nastavi se pristup k datum na utf8
    */ 
   public static function connect (){
       $host = 'localhost';
       $name = 'root';
       $heslo = '';
       $databaze = 'rocnikovka';
       self::$pripojeni = mysqli_connect($host, $name, $heslo, $databaze);
       mysqli_set_charset(self::$pripojeni, "utf8");
   }
   
   /**
    * @param dotaz promenna ve kterem jsou ulozena data po selectu
    * @param array vysledek je pole ve kterém jsou uložena data z promene dotaz
    * @return tato funkce vraci promennou vysledek
    */
    
   public static function dotaz(){
       $dotaz = mysqli_query(self::$pripojeni, "SELECT l.Id, Jmeno, Prijmeni, Stat, Nazev FROM lide AS l LEFT JOIN artist AS a ON l.Artist = a.Id");
       $vysledek = mysqli_fetch_all($dotaz, MYSQLI_ASSOC); 
       return $vysledek;
   }
   
   /**
    * dale je zde moznost vytvorit novy zaznam pomoci odkazu, ktery presmeruje na form.php
    * @param string v ['Jmeno'] pomoci foreach se vypisuje Jmeno u kazdeho zaznamu
    * @param string v ['Prijmeni'] pomoci foreach se vypisuje Prijmeni u kazdeho zaznamu
    * @param string v ['Stat'] pomoci foreach se vypisuje Stat u kazdeho zaznamu
    * @param string v ['Nazev'] pomoci foreach se vypisuje Umelecke jmeno u kazdeho zaznamu
    * @return vrací tabulku v html, ktera je naplnena daty z databaze a navic ke kazdemu zaznamu v tabulce pridava moznost smazat tento zaznam ci jej zmenit
    */
   public static function vypis(){
       echo ("<table border='1'><tr><th>Id</th><th>Jméno</th><th>Přijmení</th><th>Stát</th><th>Umělecké jméno / Skupina</th><th><form action=form.php method='POST'><input type='image' src='icons/new.png' style='width: 30px; height: 30px'></form></th></tr>");
       $i = 0;
       foreach (self::dotaz() as $v){
           echo ('<tr id=$i><td>'.$v['Id'].'</td>');
           echo ('<td>'.$v['Jmeno'].'</td>');
           echo ('<td>'.$v['Prijmeni'].'</td>');
           echo ('<td>'.$v['Stat'].'</td>');
           echo ('<td>'.$v['Nazev'].'</td>');
           echo ('<td><form action="index.php?delete='.$i.'" method="POST">'.'<input type="image" src="icons/delete.png" style="width: 30px; height: 30px">'.'</form>');
           echo ('<form action="update.php?radek='.$i.'" method="POST">'.'<input type="image" src="icons/change.png" style="width: 30px; height: 30px">'.'</td></tr></form>');
           $i ++;
       }
       echo ('<table>');
   }
   
   /**
    * @param int radek oznacuje ktery radek chce uzivatel smazat
    * @param int id promenna do ktere se ulozi id podle parametru radek
    * @return smaze urceny radek dle id
    */
   public static function delete($radek){
       $id = self::dotaz()[$radek]['Id'];
       mysqli_query(self::$pripojeni, "DELETE FROM lide WHERE Id=".$id);
   }
   
   /**
    * @param string jmeno vlozene jmeno do form.php, ktere chce uzivatel pridat do databaze
    * @param string prijmeni vlozene prijmeni do form.php, ktere chce uzivatel pridat do databaze
    * @param string stat vlozeny stat do form.php, ktery chce uzivatel pridat do databaze
    * @param int artist vlozeny artist do form.php, ke kteremu chce uzivatel pripsat cloveka
    * @return vlozi do databaze jmeno, prijmeni, stat a pokud je zadan tak i artist
    */
   public static function novy($jmeno, $prijmeni, $stat,$artist){
       if ($artist != ''){
          $dotaz = mysqli_query(self::$pripojeni, "INSERT INTO lide (Jmeno, Prijmeni, Stat, Artist) VALUES ('".$jmeno."', '".$prijmeni."', '".$stat."', '".$artist."')"); 
       }
       else {
          $dotaz = mysqli_query(self::$pripojeni, "INSERT INTO lide (Jmeno, Prijmeni, Stat) VALUES ('".$jmeno."', '".$prijmeni."', '".$stat."'"); 
       }
       
   }
   
   /**
    * @param int id oznacuje zaznam v databazi, ktery ma byt aktualizovan
    * @param string jmeno urcuje na jake jmeno ma byt dany zaznam prepsan
    * @param string prijmeni urcuje na jake prijmeni ma byt dany zaznam prepsan
    * @param string stat urcuje na jaký stat ma byt dany zaznam prepsan
    * @param int artist urcuje k jakemu artistovy ma byt dany zaznam pripsan
    * @return prepise vsechny bunky u daneho zaznamu podle odeslaneho formulare
    */
   public static function update($id, $jmeno, $prijmeni, $stat, $artist){
       $dotaz = mysqli_query(self::$pripojeni, "UPDATE lide SET Jmeno ='".$jmeno."', Prijmeni ='".$prijmeni."', Stat ='".$stat."', Artist ='".$artist."' WHERE Id=".$id."");
   }
   
   /**
    * @param int radek urcuje radek ktery ma byt aktualizovan
    * @param int id urcuje id zaznamu, ktery ma byt aktualizovan
    * @param array napln v sobe nese data o urcenem zaznamu z databaze, ktery ma byt aktualizovan
    * @returt data o urcenem zaznamu, ktera naplni vytvoreni formular, aby uzivatel nemusel psat veskera data, ktera nechce menit
    */
   public static function napln(){
       $radek = filter_input(INPUT_GET, 'radek');
       $id = self::dotaz()[$radek]['Id'];
       $dotaz = mysqli_query(self::$pripojeni, "SELECT * FROM lide WHERE Id='".$id."'");
       $napln = $vysledek = mysqli_fetch_all($dotaz, MYSQLI_ASSOC);
       return $napln;
   }
   
}

