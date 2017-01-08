<?php
$db_host="localhost"; 
$db_name="organization"; 
$db_user="root"; 
$db_passwd=""; 
$last_name = "";
$first_name = "";
$position = "";

if (isset($_POST["click"]))
{
    if(!empty($_POST["last_name"]) && !empty($_POST["first_name"]) && !empty($_POST["position"])) 
    {
        $link = mysqli_connect($db_host, $db_user, $db_passwd, $db_name); 
        if ($result = mysqli_query($link, "SELECT COUNT(*) AS id FROM employees")) 
        {
            $row = mysqli_fetch_assoc($result);
            $count = $row['id']+1;
        }
        if (mysqli_query($link, "INSERT INTO employees VALUES ($count, '".$_POST['last_name']."', '".$_POST['first_name']."', '".$_POST['position']."')"))
        {
            echo "Ваши данные успешно добавлены!<br>";        
        }
        else
        {
            echo "Ваши данные не добавлены!<br>";        
        }    
        header("location: index.php");
    }
}

$link = mysqli_connect($db_host, $db_user, $db_passwd, $db_name);
if (!$link) {
    printf("Ошибка! Невозможно установить соединение с $db_name!<br>"); 
    exit;
}

printf("Соединение с $db_name установлено!<br><br>");
         
if ($result = mysqli_query($link, "SELECT * FROM employees"))
{
    echo "<table width='100%'>";
    echo "<table border=2>";
    echo "<tr><td>ID</td><td>Last Name</td><td>First Name</td><td>Position</td></tr>";
    while ($row=mysqli_fetch_assoc($result))
    {
        $pole1=$row["id"];
        $pole2=$row["last_name"];
        $pole3=$row["first_name"];
        $pole4=$row["position"];

        echo "<tr><td>$pole1</td><td>$pole2</td><td>$pole3</td><td>$pole4</td></tr>";
    }
echo "</table><br>";
}    
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Site</title>
        <meta charset="UTF-8">        
    </head>
    <body>
        <form id="feedback" name="feedback" method="post" autocomplete="off"> <br>
             last_name <input type="text" name="last_name" value="<?php echo $last_name;?>" size="10"/> 
             first_name <input type="text" name="first_name" value="<?php echo $first_name;?>" size="10"/>
             position <input type="text" name="position" value="<?php echo $position;?>" size="10"/>            
             <input type="submit" name="click" value="Добавить пользователя"/>
        </form>
    </body>
</html>
