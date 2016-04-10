<?php

class db {
    
    private static $pripojeni;
    
    
   /**
    * 
    */ 
   public static function connect (){
       $host = 'localhost';
       $name = 'root';
       $heslo = '';
       $databaze = 'rocnikovka';
       self::$pripojeni = mysqli_connect($host, $name, $heslo, $databaze);
       mysqli_set_charset(self::$pripojeni, "utf8");
   }
   
   public static function dotaz(){
       $dotaz = mysqli_query(self::$pripojeni, "SELECT l.Id, Jmeno, Prijmeni, Stat, Nazev FROM lide AS l LEFT JOIN artist AS a ON l.Artist = a.Id");
       $vysledek = mysqli_fetch_all($dotaz, MYSQLI_ASSOC); 
       return $vysledek;
   }
   
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
   
   public static function delete($radek){
       $id = self::dotaz()[$radek]['Id'];
       mysqli_query(self::$pripojeni, "DELETE FROM lide WHERE Id=".$id);
   }
   public static function novy($jmeno, $prijmeni, $stat,$artist){
       if ($artist != ''){
          $dotaz = mysqli_query(self::$pripojeni, "INSERT INTO lide (Jmeno, Prijmeni, Stat, Artist) VALUES ('".$jmeno."', '".$prijmeni."', '".$stat."', '".$artist."')"); 
       }
       else {
          $dotaz = mysqli_query(self::$pripojeni, "INSERT INTO lide (Jmeno, Prijmeni, Stat) VALUES ('".$jmeno."', '".$prijmeni."', '".$stat."'"); 
       }
       
   }
   public static function update($id, $jmeno, $prijmeni, $stat, $artist){
       $dotaz = mysqli_query(self::$pripojeni, "UPDATE lide SET Jmeno ='".$jmeno."', Prijmeni ='".$prijmeni."', Stat ='".$stat."', Artist ='".$artist."' WHERE Id=".$id."");
   }
   public static function napln(){
       $radek = filter_input(INPUT_GET, 'radek');
       $id = self::dotaz()[$radek]['Id'];
       $dotaz = mysqli_query(self::$pripojeni, "SELECT * FROM lide WHERE Id='".$id."'");
       $napln = $vysledek = mysqli_fetch_all($dotaz, MYSQLI_ASSOC);
       return $napln;
   }
   
}

