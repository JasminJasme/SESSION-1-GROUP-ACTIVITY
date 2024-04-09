<?php
$serverName = "localhost";
$user = "root";
$pass = "";
$databaseName = "session1";
$conn = new mysqli($serverName, $user, $pass, $databaseName);
if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

$sql = "SELECT assets.assetSN, assets.AssetNAME, departments.Name 
FROM assets 
INNER JOIN departments ON assets.AssetGroupID = departments.ID";
$result = $conn->query($sql);

$sql = "SELECT assets.assetSN, assets.AssetNAME, departments.Name 
FROM assets 
INNER JOIN departments ON assets.AssetGroupID = departments.ID";
$result2 = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asset Catalogue</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

</head>

<body>
<div class="session-container">
   <div class="container">
    <form action="" method="post">
        <select name="DepartmentList" id="DepartmentList">
            <option value="">Departments</option>
            <option value="Exploration">Exploration</option>
            <option value="Production">Production</option>
            <option value="Transportation">Transportation</option>
            <option value="R&D">R&D</option>
            <option value="Distribution">Distribution</option>
            <option value="QHSE">QHSE</option>
        </select>

        <select name="AssetGroupList" id="AssetGroupList">
            <option value="">Asset Group</option>
            <option value="Hydraulic">Hydraulic</option>
            <option value="Electrical">Electrical</option>
            <option value="Mechanical">Mechanical</option>
        </select><br><br>

        <label style="margin: 10px 10px 10px 10px">Warranty Date Range</label><br><br>

        <label style="margin: 10px 10px 10px 10px">Starting Date</label>
        <input type="date" name="startDate" id="startDate" value="<?php if (isset($_POST['startDate']))
            echo $_POST['startDate']; ?>">

        <label style="margin: 10px 10px 10px 10px">End Date</label>
        <input type="date" name="endDate" id="endDate" value="<?php if (isset($_POST['endDate']))
            echo $_POST['endDate']; ?>"><br><br><br>
     
        <div class="search-container" >
        <i class="fas fa-book-open"></i>
                <input type="search" name="search" Id="search"  style = "width: 370px; margin-left:2px; font-size: 18px;"
                value="<?php echo htmlspecialchars(isset($_POST['search']) ? $_POST['search'] : '', ENT_QUOTES); ?>"  placeholder="Search...">
                <button type="submit" name="submit"  class ="searchbtn"><i class="fas fa-search"></i></button>
        </div>

    </form>
    <div class = "assetlist"> 
    <label>Asset List</label><br>
    </div>        
    <?php

    if (!empty($_POST['search'])) {
        $searchTerm = $_POST['search'];

        $sql = "SELECT assets.assetSN, assets.AssetNAME, departments.Name 
        FROM assets 
        INNER JOIN departments ON assets.AssetGroupID = departments.ID 
        WHERE assets.AssetNAME LIKE '%$searchTerm%'";

        $result = $conn->query($sql);
    }



    if (isset($_POST["submit"])) {
        if (!empty($_POST['DepartmentList'])) {
            $str = $_POST["DepartmentList"];
            $sql = "SELECT assets.assetSN, assets.AssetNAME, departments.Name 
            FROM assets 
            INNER JOIN departments ON assets.AssetGroupID = departments.ID 
            WHERE departments.Name LIKE '%$str%'";
            $result = $conn->query($sql);
        }
    }



    if (isset($_POST["submit"])) {
        if (!empty($_POST['AssetGroupList'])) {
            $str = $_POST["AssetGroupList"];

            $sql = "SELECT assets.assetSN, assets.AssetNAME, departments.Name 
            FROM assets 
            INNER JOIN departments ON assets.AssetGroupID = departments.ID
            INNER JOIN assetgroups ON assets.AssetGroupID = assetgroups.ID 
            WHERE assetgroups.Name = '$str'";
            $result = $conn->query($sql);
        }
    }

    if (isset($_POST["submit"])) {
        if (!empty($_POST['startDate'])) {
            $str = $_POST["startDate"];

            $sql = "SELECT assets.assetSN, assets.AssetNAME, departments.Name 
            FROM assets 
            INNER JOIN departmentlocations ON assets.DepartmentLocationID = departmentlocations.ID
            INNER JOIN departments ON departmentlocations.departmentID = departments.ID
            WHERE departmentlocations.StartDate = '$str'";
            $result = $conn->query($sql);
        }
    }

    if (isset($_POST["submit"])) {
        if (!empty($_POST['endDate'])) {
            $str = $_POST["endDate"];

            $sql = "SELECT assets.assetSN, assets.AssetNAME, departments.Name 
            FROM assets 
            INNER JOIN departmentlocations ON assets.DepartmentLocationID = departmentlocations.ID
            INNER JOIN departments ON departmentlocations.departmentID = departments.ID
            WHERE departmentlocations.EndDate = '$str'";
            $result = $conn->query($sql);
        }
    }



    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            ?>
             <div class="table-container">
               <table>
                <thead>
                </thead>
                <tbody>
                    <tr>
                        <td>
                        <img src="img/Null-Item.png" height="60px" width="60px" style="margin: 10px 10px 10px 10px">        
                        </td>
                        <td style="width:300px;">
                            <?php echo $row['AssetNAME']; ?><br>
                            <?php echo $row['Name']; ?><br>
                            <?php echo $row['assetSN']; ?><br>
                        </td>
                        <td>
                           
                            <a href="EditAsset.php? id=<?php echo $row['assetSN']; ?> "><i class="fas fa-pen"></i></a>
                            <a href="transferasset.php? id=<?php echo $row['assetSN']; ?> "><i class="fas fa-share-square"></i></a>
                            <a href="Historytransfer.php? id=<?php echo $row['assetSN']; ?> "> <i class="fas fa-history"></i></a>
                         
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <?php  
         }
        } else {
        ?>
        <label>No Assets Found.</label>
        <?php
         }
         ?>
        <div>

     <div class = "numrows">
       <?php echo mysqli_num_rows($result) . " out of " . mysqli_num_rows($result2) ?><br>
     </div>
    <a href="AddNA.php"><button class="round-button">+</button></a>

  </div>
</div>

<div class="landscape-div">
    <div class="container1" >
    
       <?php 
        $sql1 = "SELECT AssetSN, Name, AssetName 
                FROM assets
                JOIN departments ON assets.DepartmentLocationID = departments.ID";                    
        $result2 = $conn->query($sql1);
        ?>

        <p>My Asset List:</p>
        <table class= "table-contain">
            <thead></thead>
            <tbody>
                <?php 
                if ($result2->num_rows > 0) {
                    while ($row = $result2->fetch_assoc()) {
                ?>
                        <tr>
                            <td>
                                <img src="img/Null-Item.png" height="60px" width="60px" style="margin: 10px 10px 10px 10px">
                            </td>
                            <td style="width:100%;">
                                <?php echo $row['AssetName'];?> - <?php echo $row['AssetSN'];?>
                            </td>
                            <td>
                                <a href="UpdateAssets.php"><i class="fas fa-pen" style="margin-right:10px"></i></a>
                            </td>
                        </tr>
                <?php 
                    }
                } else {
                    echo "<tr><td colspan='3'>No assets found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <div class = "numrows">
       <?php echo mysqli_num_rows($result) . " out of " . mysqli_num_rows($result2) ?><br>
     </div>
    <a href="AddNA.php"><button class="round-button">+</button></a>
   </div>
</div>

<?php
    // Close connection
    $conn->close();
?>

<script>
  
  document.addEventListener('DOMContentLoaded', function() {
    var searchInput = document.getElementById('search');

    // On input change, capitalize the first letter of each word in the value
    searchInput.addEventListener('input', function() {
        this.value = this.value.replace(/\b\w/g, function(char) {
            return char.toUpperCase();
        });
    });
});
     document.addEventListener("DOMContentLoaded", function() {
    const sessionContainer = document.querySelector(".session-container .container");
    const landscapeDiv = document.querySelector(".landscape-div");

    // Function to toggle elements based on orientation
    function toggleElementsBasedOnOrientation() {
        if (window.matchMedia("(orientation: portrait)").matches) {
            // Portrait orientation, show session container and hide landscape div
            sessionContainer.style.display = "none";
            landscapeDiv.style.display = "block";
            console.log("landscape");
        } else {
            // Landscape orientation, show landscape div and hide session container
            sessionContainer.style.display = "block";
            landscapeDiv.style.display = "none";
            console.log("portrait");
        }
    }

    // Initial check on page load
    toggleElementsBasedOnOrientation();

    // Listen for orientation change events
    window.addEventListener("orientationchange", function() {
        // Re-check orientation and toggle elements accordingly
        toggleElementsBasedOnOrientation();
    });
});
</script>


</body>
</html>
<script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>