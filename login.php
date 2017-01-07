<?php
$login="";
$password="";
$log="";
$passwd="";
$db_host="localhost"; 
$db_name="organization"; 
$db_user="root"; 
$db_passwd=""; 

if (isset($_POST["click"]))
{
   if(!empty($_POST["login"]) && !empty($_POST["password"]))
   {
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
            $log=$row["login"];
        }
        if($log==$_POST["login"] && $passwd==$_POST["password"])
        {
            header("location: secret.php?key=".md5($_POST["password"]).md5($_POST["login"]));
            exit();
        }
        else
        {
           $result = mysqli_query($link, "SELECT * FROM logins WHERE logins.login='".$_POST["login"]."' AND logins.password='".$_POST["password"]."'");
           if ($result)
           {
               $row=mysqli_fetch_assoc($result);
               $id=$row["id"];
               $result = mysqli_query($link, "SELECT * FROM employees WHERE employees.id=$id");  
               $row=mysqli_fetch_assoc($result);
               $last_name=$row["last_name"];
               $first_name=$row["first_name"];
               $name = $last_name." ".$first_name;
               header("location: authorization.php?result=".$name);
               exit();
               
           }

        }
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
             login: <input type="text" name="login" value="<?php echo $login;?>" size="10"/>
             password: <input type="text" name="password" value="<?php echo $password;?>" size="10"/>
             <input type="submit" name="click" value="Войти"/>
        </form>
    </body>
</html>
