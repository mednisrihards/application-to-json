 <?php

   include "functions.php";  //Pievienots fails, kurā atrodas izmantotās funkcijas
    
    if(isset($_POST['submit'])){                      //Pārbauda vai forma ir apstiprināta
        $person->name = $_POST['name'] ;
        $person->lastName = $_POST['lastName'] ;
        $person->birthDate = $_POST['birthDate'] ;
        $person->age = ageCheck($person->birthDate); // Funkcija aprēķina personas vecumu
        $image = $_FILES['img'];
        $errorMsg = "";
        
        // Tukšu lauku un vecuma pārbaude
        
        
        
        if ($person->age < 18){
        $errorMsg = "Jūs neesat sasniedzis 18 gadu vecumu, lai piedalītos";
        }
            else {
                addImage($image);                //Attēla augšupielādes funkcija
                addRecord($person);              //Funkcija datu pievienošanai JSON failā
                header("Location: index.php");   //pāradresācija uz formu(index.php)
            }
    };