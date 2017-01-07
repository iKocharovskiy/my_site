<?php
$login="";
$db_host="localhost"; 
$db_name="organization"; 
$db_user="root"; 
$db_passwd=""; 
$id_user="";
$login_user="";
$password_user="";


$link = mysqli_connect($db_host, $db_user, $db_passwd, $db_name); 
if (!$link) 
{
    printf("Ошибка! Невозможно установить соединение с $db_name!<br>"); 
    exit();
}
printf("Соединение с $db_name установлено!<br><br>");
if ($result = mysqli_query($link, "SELECT * FROM logins WHERE id='1'")) 
{ 
    $row=mysqli_fetch_assoc($result);   
    $passwd=$row["password"]; 
    $login=$row["login"];
}
if($_GET["key"] != md5($passwd).md5($login))
{
    header("location: login.php");
    exit();
}

if ($result = mysqli_query($link, "SELECT * FROM logins")) 
{ 
    echo "<table width='100%'>";
    echo "<table border=2>";
    echo "<tr><td>ID</td><td>Login</td><td>Password</td></tr>";
    while ($row=mysqli_fetch_assoc($result))
    {
        $pole1=$row["id"];
        $pole2=$row["login"];
        $pole3=$row["password"];
        echo "<tr><td>$pole1</td><td>$pole2</td><td>$pole3</td></tr>";
    }
echo "</table><br>";
}
$result = mysqli_query($link, "SELECT * FROM employees WHERE employees.id NOT IN (SELECT logins.id FROM logins)");
if (mysqli_num_rows($result) > 0)
{
    echo "Следующим пользователям нужно установить логин и пароль: <br><br>";
    if ($result)
    { 
        echo "<table width='100%'>";
        echo "<table border=2>";
        echo "<tr><td>ID</td><td>Last Name</td><td>First Name</td></tr>";
        while ($row=mysqli_fetch_assoc($result))
        {
            $pole1=$row["id"];
            $pole2=$row["last_name"];
            $pole3=$row["first_name"];

            echo "<tr><td>$pole1</td><td>$pole2</td><td>$pole3</td></tr>";
        }
    echo "</table><br>";
    }
}

if (isset($_POST["click"]))
{
    if(!empty($_POST["id_user"]) && !empty($_POST["login_user"]) && !empty($_POST["password_user"])) 
    {
        $link = mysqli_connect($db_host, $db_user, $db_passwd, $db_name); 
        mysqli_query($link, "INSERT INTO logins VALUES ('".$_POST['id_user']."', '".$_POST['login_user']."', '".$_POST['password_user']."')");       
        header("location: secret.php?key=".md5($passwd).md5($login));
    }

}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Site</title>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <form method="post" autocomplete="off"> <br>
             id_user <input type="text" name="id_user" value="<?php echo $id_user;?>" size="10"/> 
             login_user <input type="text" name="login_user" value="<?php echo $login_user;?>" size="10"/>
             password_user <input type="text" name="password_user" value="<?php echo $password_user;?>" size="10"/>            
             <input type="submit" name="click" value="Добавить логин и пароль пользователю"/>
        </form>
    </body>
</html>
