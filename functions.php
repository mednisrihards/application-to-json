<?php 


//--------------------------------VECUMA APRĒĶINĀŠANA----------------------------------------

function ageCheck($birthDate){
    $today = date("d.m.Y");
    $diff = date_diff(date_create($birthDate), date_create($today));    //Aprēķina laika posmu starp šodienas datumu un personas dzimšanas datumu
    $age = $diff->format('%Y');      //Saglabā personas vecumu mainīgajā
    return $age;                     // Atgriež personas vecumu
}



//--------------------------------ATTĒLA PIEVIENOŠANA----------------------------------------

function addImage($image){
    
    $imageName = $image['name'];
    $imageTemp = $image['tmp_name'];
    $imageExtension = explode('.', $imageName);           //atdala paplašinājumu no nosaukuma
    $imageExtension = strtolower(end($imageExtension));   //saglabā tikai paplašinājumu
    $allowedExtensions = array('jpg', 'jpeg', 'png');             //Pieļaujamo paplašinājumu masīvs
    
    
//---------Pārbaude "Vai direktorija eksistē". Ja nē, tad izveido direktoriju.
$dir = "./IMAGES";
if(!is_dir($dir)){
    mkdir($dir, 0777, true);
}
    
        if(in_array($imageExtension, $allowedExtensions)){                  //Pārbauda vai faila paplašīnājums ir atļauts
            global $newImageName;
            $newImageName = uniqid('', true) . '.' . $imageExtension;       //Ģenerē jaunu faila nosaukumu
            $imageDestination = 'images/' . $newImageName;                  //Faila glabāšanas vieta
            move_uploaded_file($imageTemp, $imageDestination)               //Augšupielādē failu serverī
            or exit("Attēla augšupielāde neveiksmīga");                     //Pārstāj izpildīt kodu, ja attēla ielāde bijusi neveiksmīga
        }
        else{
            exit("Attēla augšupielāde neveiksmīga");                        //Pārstāj izpildīt kodu, ja faila paplašinājums nav atļauts
        }
}


//--------------------------------PIETEIKUMA PIEVIENOŠANA------------------------------------

function addRecord($person){
    global $newImageName;        //Ģenerētais, jaunais faila nosaukums
        $person->imageRef = "$newImageName";        
        

    
//---------Pārbaude "Vai direktorija eksistē". Ja nē, tad izveido direktoriju.
$dir = "./JSON";
if(!is_dir($dir)){
    mkdir($dir, 0777, true);
}
    
//--------Pārbauda vai fails eksistē, ja neeksistē, tad izveido failu
$filename = "applications.json"; 
$destination = "JSON/" . $filename;
    if (!file_exists($destination)){ 
     $file = fopen($destination, "w");
 }
        // Nolasa JSON failu
        $data = file_get_contents($destination);

        // Izveido masīvu ar JSON datiem
        $json_arr = json_decode($data, true);

        // Pievieno datus masīvam
        $json_arr[] = array('name'=>$person->name, 'lastName'=>$person->lastName, 'birthDate'=>$person->birthDate, 'imageRef'=>$person->imageRef);

        // Pārveido masīvu par JSON datiem JSON sintaksē un saglabā failu
        file_put_contents($destination, json_encode($json_arr, JSON_PRETTY_PRINT));     
    

// ---------------------------------------KODS KATRA PIETEIKUMA JAUNA FAILA ĢENERĒŠANAI-----------------------------------


//
//$filename = $person->name . "_" . $person->lastName . ".json";
//$destination = "JSON/" . $filename;
//    
//     $file = fopen($destination, "w");     //Izveido failu
//
//        // Pievieno datus masīvam
//        $json_arr[] = array('name'=>$person->name, 'lastName'=>$person->lastName, 'birthDate'=>$person->birthDate, 'imageRef'=>$person->imageRef);
//
//        // Pārveido masīvu par JSON datiem JSON sintaksē un saglabā failu
//        file_put_contents($destination, json_encode($json_arr, JSON_PRETTY_PRINT));     
  
}

//----------------------------------------JSON faila nolasīšana----------------------------------------

function getRecords() {

    $file = "JSON/applications.json";

        // Nolasa JSON failu
        $data = file_get_contents($file);

        // Izveido masīvu ar JSON datiem
        $json_arr = json_decode($data, true);

    for ($i=0; $i < count($json_arr); $i++) { 
        echo '<tr>';
            echo '<td>';
                print_r($json_arr[$i][name]);
            echo '</td>';
            echo '<td>';
                print_r($json_arr[$i][lastName]);
            echo '</td>';
            echo '<td>';
                print_r($json_arr[$i][birthDate]);
            echo '</td>';
            echo '<td>';
                print_r($json_arr[$i][imageRef]);
            echo '</td>';
        echo '</tr>';
    }
}
?>