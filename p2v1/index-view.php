<!DOCTYPE html>
<html lang='en'>
<head>
    <title>e15 Project 2v1</title>
    <meta charset='utf-8'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    
    <!-- My CSS -->
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>

<body>
    <br><br>
    <h1>Volunteer Hour Calculator</h1>
    <p id="subtitle">Reads sample file and outputs total volunteer hours for student listed in either hours or minutes.</p>
    <br>
    
    <!--
    INPUT
    -->
    <div id="vHourInput">
        <form method='POST' action='process.php'>
            <fieldset>
                <label for='inputFile' id="headerMedium">Choose a Data Set: </label>
                <!-- Create two files for the user to select from a drop down list and then have that file upload to be read and processed then output the users requested data-->
                <br>
                <select id="inputFile" name="inputFile">
                  <option value="sampleOne">Sample 1</option>
                  <option value="sampleTwo">Sample 2</option>
                </select>
                <br><br><br>

                <p id="headerMedium">Student Name:</p>
                <label for='studentFirstName'> </label>
                <input type='text' name='studentFirstName' id='studentFirstName' placeholder="First" required>
                <br>
                <label for='studentLastName'></label>
                <input type='text' name='studentLastName' id='studentLastName' placeholder="Last" required>
                <br><br><br><br>

                <p id="headerMedium">Display Total Time As:</p><br>
                <label for='hours'>Hours</label>
                <input type='radio' id='hours' name='timeDisplayHours' value='hours'><br>
                <label for='minutes'>Minutes</label>
                <input type='radio' id='minutes' name='timeDisplayMinutes' value='minutes'>

                <br><br><br>

                <button type='submit'>Process</button>
            </fieldset>
        </form>
    </div>
    
    
    <!--
    OUTPUT 
    -->
    <div id="vHourOutput">
        <!--output from the form selection-->
        <?php if(isset($results)) : ?>
          
          <p id="headerMedium">Volunteer Information</p>
          <!--Display all of the form data -->
          <p>inputFile: &nbsp;<?=$inputFile?></p>
          <p>studentFirstName: &nbsp;<?=$studentFirstName?></p> 
          <p>studentLastName: &nbsp;<?=$studentLastName?></p>
          <p>timeDisplayHours: &nbsp;<?=$timeDisplayHours?></p>
          <p>timeDisplayMinutes: &nbsp;<?=$timeDisplayMinutes?></p>
          <p><?=$fileReadSize?></p>
          <p><?=$fileReadText?></p>
        <?php endif ?>
    </div>
    
</body>
</html>