<!DOCTYPE html>
<html lang="">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>JSON</title>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;400;900&display=swap" rel="stylesheet">
  <link href="bootstrap.css" rel="stylesheet">
  <link href="style.css" rel="stylesheet">
</head>

<body>
    <header>
        <h1> Application data to JSON </h1>
    </header>
    <div class="wrapper">

        <div class="containers">
        <div class="left">
            <ul>
                <li><img src="assets/save-solid.svg" alt="Save data"><p>Saving appliciant data to JSON file</p></li>
                <li><img src="assets/folder-plus-solid.svg" alt="Save photo"><p>Saving added photo with unique identifier to "IMAGES" folder</p></li>
                <li><img src="assets/map-pin-solid.svg" alt="Adding reference"><p>Adding a reference to the uploaded photo</p></li>
            </ul>
            <form class="download-btn" action="download.php" action="POST">
                <input type="submit" value="Download JSON and Photos (*.zip)">
            </form>
        </div>
        <div class="right">

            <!-------------------------------------------FORMA DATU IEVADEI --------------------------------------------------------->
            
            <form action="addApplication.php" method="POST" enctype="multipart/form-data">
                <label for="name">
                    <span class="input-name">Vārds</span>
                </label>
                <input type="text" class="custom-input " required="required" name="name" autocomplete="off">
        
                <label for="lastName">
                    <span class="input-lName">Uzvārds</span>
                </label>
                <input type="text" class="custom-input " required="required" name="lastName" autocomplete="off">
        
                <label for="birthDate">
                    <span class="input-birthDate">Dzimšanas datums (dd.mm.yyyy)</span>
                </label>
                <input type="date" class="custom-input " name="birthDate" required="required" required pattern="\d{2}.\d{2}.\d{4}" autocomplete="off">
                
                <label for="img">
                    <span class="input-img">Attēls (*.jpg, *.jpeg, *.png)</span>
                </label>
                <input type="file" class="custom-btn custom-input " required="required" name="img" autocomplete="off">
        
                <input type="submit" class="custom-btn" name="submit" value="Pievienot">
            </form>
        </div>
    </div>
        <table>
            <tr>
                <th>Name</th>
                <th>Last name</th>
                <th>Date of birth</th>
                <th>Photo</th>
            </tr>
                <?php include('functions.php'); getRecords(); ?>
        </table>
    </div>

</body>
</html>
