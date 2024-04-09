<?php
$serverName = "localhost";
$user = "root";
$pass = "";
$databaseName = "session1";
$conn = new mysqli($serverName, $user, $pass, $databaseName);
if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);

}
$sql = "SELECT * from assets";
$result = $conn->query($sql);

$sql1 = "SELECT * from departmentlocations";
$result1 = $conn->query($sql1);

if (isset($_POST['submit'])) {

    $AssetSNid = mysqli_num_rows($result) + 1;

    $DepartmentLocationID = mysqli_num_rows($result1) + 1;

    $assetName = $_POST['assetName'];

    $DepartmentList = $_POST['DepartmentList'];

    $LocationList = $_POST['LocationList'];

    $AssetList = $_POST['AssetList'];

    $EmployeeList = $_POST['EmployeeList'];

    $AssetDesc = $_POST['AssetDesc'];

    $expMonth = $_POST['expMonth'];

    $DD = str_pad($DepartmentList, 2, '0', STR_PAD_LEFT);
    $GG = str_pad($AssetList, 2, '0', STR_PAD_LEFT);
    $NNNN = str_pad($AssetSNid, 4, '0', STR_PAD_LEFT);

    $AssetSN = "" . $DD . "/" . $GG . "/" . $NNNN;


    $sql1 = "INSERT INTO assets (AssetSN, AssetName, DepartmentLocationID, EmployeeID, AssetGroupID, Description, WarrantyDate)
            VALUES ('$AssetSN', '$assetName', '$DepartmentList', '$EmployeeList', '$AssetList', '$AssetDesc', '$expMonth')";
    $sql = "INSERT INTO departmentlocations (DepartmentID, LocationID) VALUES ('$DepartmentList', '$LocationList')";

    if ($conn->query($sql) and $conn->query($sql1) === TRUE) {
        echo "<script>alert('Data was created successfully.'); window.location='index.php';</script>";

    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Add New Assets</title>

</head>

<body>
<div class="session-container1">
 <div class="container">
 
    <div class="AssetInfo">
    
        <span>Asset Information</span>
        <a href="index.php"> <button class="backbtn">Back</button></a>
    </div>
    <form action="" method="POST">
          <br>
        <span style=" margin: 10px 10px 10px 10px;">Asset Name</span><br>
        <input type="text" name="assetName" style=" margin: 10px 10px 10px 10px; width: 360px; font-size:16px "><br>
        <select name="DepartmentList" id="DepartmentList">
            <option value="">Departments</option>
            <option value="1">Exploration</option>
            <option value="2">Production</option>
            <option value="3">Transportation</option>
            <option value="4">R&D</option>
            <option value="5">Distribution</option>
            <option value="6">QHSE</option>
        </select>

        <select name="LocationList" id="LocationList">
            <option value="">Location</option>
            <option value="1">Kazan</option>
            <option value="2">Volka</option>
            <option value="3">Moscow</option>
        </select><br>

        <select name="AssetList" id="AssetList">
            <option value="">Asset Group</option>
            <option value="1">Hydraulic</option>
            <option value="3">Electrical</option>
            <option value="4">Mechanical</option>
        </select>

        <select name="EmployeeList" id="EmployeeList">
            <option value="">Accountable Party</option>
            <option value="1">Winegarden, Martina</option>
            <option value="2">Brammer, Rashida</option>
            <option value="3">Krall, Mohamed</option>
            <option value="4">Karr, Shante</option>
            <option value="5">Rames, Rosaura</option>
            <option value="6">Courchesne, Toi</option>
            <option value="7">Wismer, Precious</option>
            <option value="8">Otte, Josefa</option>
            <option value="9">Harrington, Afton</option>
            <option value="10">Morrow, Daphne</option>
            <option value="11">Polson, Dottie</option>
            <option value="12">Nally, Allen</option>
            <option value="13">Odom, Hilton</option>
            <option value="14">Hillebrand, Shawn</option>
            <option value="15">Kettler, Lorelei</option>
            <option value="16">Gossage, Jalisa</option>
            <option value="17">Sim, Germaine</option>
            <option value="18">Wollman, Suzanna</option>
            <option value="19">Besse, Jennette</option>
            <option value="20">Anstine, Margherita</option>
            <option value="21">Lambright, Earleen</option>
            <option value="22">Valdavia, Lyn</option>
            <option value="23">Couey, Alycia</option>
            <option value="24">Rousey, Lewis</option>
            <option value="25">Profitt, Tanja</option>
        </select><br><br>


        <span style=" margin: 10px 10px 10px 10px;" >Asset Description</span><br>
        <textarea name="AssetDesc" id="" cols="30" rows="2" style=" margin: 10px 10px 10px 10px; width: 360px;"></textarea><br>
        <span style=" margin-left: 10px;">Expired Warranty</span>
        <input type="date" name="expMonth" id="" style=" margin: 10px 10px 10px 10px;"><br>
        <span style=" margin: 10px 10px 10px 10px;">Asset SN</span> <input type="text" placeholder="??/11/????" readonly style=" width: 280px;"><br><br>

        <button class = "CI">Capture Image</button>
        <button class = "browse">Browse</button><br><br>


        <input type="submit" name="submit" value="Submit" class = "submit">
        <a href="index.php"><button class = "cancel">Cancel</button></a>
    </form>

</div>
</div>

</body>
</html>