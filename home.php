<?php 
session_start();
if (isset($_SESSION['id']) || isset($_SESSION['username'])) 
{
?>
<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <title>HOME</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body class="guru">
    
    <nav class="navbar navbar-expand-lg navbar-dark bg-light ">
    <a class="navbar-brand" href="#">
    <img src="Apple_logo_black.svg" width="30" height="30" alt="">
  </a>
  <ul class="navbar-nav ml-auto">
      <li>
        <h1>Welcome, <?php echo $_SESSION['username']; ?></h1>
    </li>
    </ul>
    <ul class= "navbar-nav ms-auto mb-2 mb-lg-0">
    <li>
         <a href="login.php">Logout</a>  
    </li>
    </ul>
    </nav>
     <div class="done">
        <center>
            <form action="server.php" method="post">
                <h2>Please fill the form </h2>
                <table>
                    <tr>
                        <td><label>Name</label></td>
                        <td><input type="text" name="name" required></td>
                    </tr>
                    <tr>
                        <td><label>Blood Group: </label></td>
                        <td><select name="grp">
                         <option value="A+">A+</option>
                         <option value="A-">A-</option>
                         <option value="B+">B+</option>
                         <option value="B-">B-</option>
                         <option value="O+">O+</option>
                         <option value="O-">O-</option>
                         <option value="AB+">AB+</option>
                         <option value="AB-">AB-</option>
                         </select>
                         </td>
                    </tr>
                    <tr>
                         <td><label>City: </label></td>
                         <td>
                         <select name="city">
                             <option value="Hyderabad">Hyderabad</option>
                         </select>
                         </td>
                    </tr>
                    <tr>
                         <td><label>Hospital Area:</label></td>
                         <td>
                         <select name="harea" onchange="areachange(this);">
                             <option value="empty">Select a area</option>
                             <option value="LB nagar">LB nagar</option>
                             <option value="KPHB">KPHB</option>
                         </select>
                         </td>
                    </tr>
                    <tr>
                         <td><label>Hospital Name: </label></td>
                         <td>
                         
                         <select name="hname" id="area" >
                         <option value="0">select a hospital</option>
                         </select>
                         </td>
                    </tr>
                    
                    <tr>
                        <td><label>Phone : </label></td>
                        <td><input type="number" name="phone"></td>
                    </tr>
                    

                    <tr>
                        <td><label>Date : </label></td>
                        <td><input type="date" name="day" required></td>
                    </tr>
                </table> 
                <button type="submit" name="bdonor">Submit</button>
            </form>
        </center>
    </div>
    <script>
        var arealist = new Array(2);
        arealist["empty"]=["select a area"];
        arealist["LB nagar"]=["spandana","vandana","aradana"];
        arealist["KPHB"]=["guru","sanju","manoj"];
        function areachange(selectObj){
            var idx=selectObj.selectedIndex;
            var which=selectObj.options[idx].value;
            alist=arealist[which];
            var aselect=document.getElementById("area");
            var len=aselect.options.length;
            while(aselect.options.length>0){
                aselect.remove(0);
            }
            var newOption; 
        for (var i=0; i<alist.length; i++) { 
            newOption = document.createElement("option"); 
            newOption.value = alist[i];  // assumes option string and value are the same 
            newOption.text=alist[i]; 
        try { 
            aselect.add(newOption);  // this will fail in DOM browsers but is needed for IE 
            } 
        catch (e){ 
            aselect.appendChild(newOption); 
            }    
        } 
        }
    </script>
    
</body>
</html>
<?php 
}
else
{
     header("Location: login.php");
     exit();
}
?>