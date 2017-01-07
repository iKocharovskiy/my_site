<?php
$last_name=$_POST["last_name"];
$first_name=$_POST["first_name"];
$position=$_POST["position"];
$res=-1;
if ($last_name="")
        $res=1;
if ($first_name="")
        $res=2;
if($position="")
        $res=3;

echo getAnswer($res);

function getAnswer($res=0)
{
    if ($res==0)
    {
        $answer="";
    }
    if ($res==1)
    {
        $answer="Пустое поле last_name!";
    }
    if ($res==2)
    {
        $answer="Пустое поле first_name!";
    }
    if ($res==3)
    {
        $answer="Пустое поле position!";
    }
}


?>

