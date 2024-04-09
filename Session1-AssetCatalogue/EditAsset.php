
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Edit Assets Information</title>
</head>

<body>

<?php
$serverName = "localhost";
$user = "root";
$pass = "";
$databaseName = "session1";
$conn = new mysqli($serverName, $user, $pass, $databaseName);
if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);

}
if (isset($_POST['discard'])){
 echo "<script>alert('Update discarded.'); window.location='index.php';</script>";
}


if (isset($_POST['update'])) {

    $DepartmentLocationID = $_POST['departmentLocID'];

    $assetName = $_POST['assetName'];

    $DepartmentList = $_POST['DepartmentList'];

    $LocationList = $_POST['LocationList'];

    $AssetList = $_POST['AssetList'];

    $EmployeeList = $_POST['EmployeeList'];

    $AssetDesc = $_POST['AssetDesc'];

    $expMonth = $_POST['expMonth'];

    $assetSN = $_POST['assetSN'];


    $sql1 = "UPDATE `assets` SET `AssetSN`='$assetSN',`AssetName`='$assetName',`DepartmentLocationID`='$DepartmentList',`AssetGroupID`='$AssetList',`Description`='$AssetDesc',`WarrantyDate`='$expMonth' WHERE `AssetSN` = '$assetSN'";
    $sql2 = "UPDATE `departmentlocations` SET `DepartmentID`='$DepartmentList',`LocationID`='$LocationList' WHERE `ID` = '$DepartmentLocationID'";

    if ($conn->query($sql1) and $conn->query($sql2) === TRUE) {
        echo "<script>alert('Data was updated successfully.'); window.location='index.php';</script>";

    } else {
        echo "Error: " . $sql1 . "<br>" . $conn->error;
        echo "Error: " . $sql2 . "<br>" . $conn->error;
    }

}
?>


<div class="session-container1">
 <div class="container">
    <div class="AssetInfo">
        <span>Asset Information</span>
        <a href="index.php"> <button  class="backbtn">Back</button></a><br>
    </div>
   
<?php if (isset ($_GET['id'])) {

$id = $_GET['id'];

$sql = "SELECT assets.assetSN, assets.AssetName, assets.DepartmentLocationID , departments.ID as Department_ID ,departments.Name AS Department_Name, departmentlocations.LocationID AS Location_ID, locations.Name AS Location_Name, assets.AssetGroupID AS AssetGroup_ID, assetgroups.Name AS AssetGroup_Name, assets.Description, assets.WarrantyDate, employees.ID AS Employee_ID, employees.FirstName AS employee_Fname, employees.LastName as employee_Lname
FROM assets
INNER JOIN assetgroups ON assets.AssetGroupID = assetgroups.ID
INNER JOIN employees ON assets.EmployeeID = employees.ID
INNER JOIN departmentlocations ON assets.DepartmentLocationID = departmentlocations.ID
INNER JOIN departments ON departmentlocations.DepartmentID = departments.ID
INNER JOIN locations ON departmentlocations.LocationID = locations.ID WHERE `AssetSN`='$id'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {


        $id = $row['assetSN'];
        $warranty = $row['WarrantyDate'];
        $assetname = $row['AssetName'];
        $department = $row['Department_Name'];
        $location = $row['Location_Name'];
        $assetgroup = $row['AssetGroup_Name'];
        $employeeFname = $row['employee_Fname'];
        $employeeLname = $row['employee_Lname'];
        $desc = $row['Description'];

        $employeeID = $row['Employee_ID'];
        $assetgroupID = $row['AssetGroup_ID'];
        $locationID = $row['Location_ID'];
        $departmentID = $row['Department_ID'];

        $DepartmentLocationID = $row['DepartmentLocationID'];

    }
    ?>

    <form action="" method="POST">
    <br>
        <span style=" margin: 10px 10px 10px 10px;">Asset Name</span><br>
        <input type="text" name="assetName"  style=" margin: 10px 10px 10px 10px; width: 360px; font-size:16px " value = "<?php echo $assetname?>"><br><br>

        <input type="hidden" name="departmentLocID" value = "<?php echo $DepartmentLocationID ?>">

        <select name="DepartmentList" id="DepartmentList">
            <option value="<?php echo $departmentID?>"><?php echo $department?></option>
            <option value="1">Exploration</option>
            <option value="2">Production</option>
            <option value="3">Transportation</option>
            <option value="4">R&D</option>
            <option value="5">Distribution</option>
            <option value="6">QHSE</option>
        </select>

        <select name="LocationList" id="LocationList">
            <option value="<?php echo $locationID?>"><?php echo $location?></option>
            <option value="1">Kazan</option>
            <option value="2">Volka</option>
            <option value="3">Moscow</option>
        </select><br>

        <select name="AssetList" id="AssetList">
            <option value="<?php echo $assetgroupID?>"><?php echo $assetgroup?></option>
            <option value="1">Hydraulic</option>
            <option value="2">Electrical</option>
            <option value="3">Mechanical</option>
        </select>

        <select name="EmployeeList" id="EmployeeList">
            <option value="<?php echo $employeeID?>"><?php echo $employeeLname?>, <?php echo $employeeFname?></option>
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


        <span style=" margin: 10px 10px 10px 10px;">Asset Description</span><br>
        <textarea name="AssetDesc" id="" cols="30" rows="2" style=" margin: 10px 10px 10px 10px; width: 360px;"><?php echo $desc?></textarea><br>
        <span style=" margin-left: 10px;">Expired Warranty</span>

        <input type="date" name="expMonth" id=""  style=" margin: 10px 10px 10px 10px;" value="<?php echo $warranty ?>"><br><br>
        <span  style=" margin: 10px 10px 10px 10px;">Asset SN</span> 
        <input type="text" placeholder="??/11/????" name="assetSN" readonly
        style=" width: 280px;" value="<?php echo $id ?>"><br><br>

        <button class = "CI">Capture Image</button>
        <button class = "browse">Browse</button><br><br>

        <input type="submit" name="update" value="Update" class = "submit">
        <input type="submit" value="Discard" name="discard" class = "cancel">
        
        
    </form>
    <?php
    
}
}
?>
    </div>
</div>
</body>

</html>