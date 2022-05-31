<html>

<body>
<form action='adamana.php' >

<?php 
error_reporting(0);

$skor=$_GET['skor'];
$durum="kontrol";
$dog=0;
$yan=0;
$db= new PDO("mysql:host=localhost;dbname=adam;charset=utf8","root","");
$say= $db->query("select count(*) as sayi  from sehircik",PDO::FETCH_ASSOC);
foreach($say as $snc)
$limit=$snc[sayi];
$kelime=$_GET['kelime'];
$rast=rand(1,$limit);

$seh= $db->query("select * from sehircik where id=$rast",PDO::FETCH_ASSOC);
foreach($seh as $sehad)
{if($kelime=='')
$kelime=$sehad[sehirad];
$uzunluk=strlen($kelime);
$degis=array();
for($z=0;$z<$uzunluk;$z++)
{$harf='harf'.$z;
$harf=$_GET[$harf];
$degis[]=$harf;
if($degis[$z]==substr($kelime,$z,1))
{
echo "<input type='text' maxlength=1 style='width:30px;height:30px;font-size:20px' name='harf$z' value=$degis[$z]>";
$dog++;
}
else
{
echo "<input type='text' maxlength=1 style='width:30px;height:30px;font-size:20px' name='harf$z' >";

}

};
if($z=$uzunluk && $dog<>$z)
{$skor++;
$can=$skor;}

};
if($can==4)
{echo "<script>alert('bilemedin')</script>";
$durum="Yeniden oyna";
$db= new PDO("mysql:host=localhost;dbname=adam;charset=utf8","root","");
$say= $db->query("select count(*) as sayi  from sehircik",PDO::FETCH_ASSOC);
foreach($say as $snc)
$limit=$snc[sayi];
$kelime=$snc[sehirad];
$rast=rand(1,$limit);
echo $rast;
$can=0;};


if($dog==$uzunluk)
{echo "<script>alert('dogru')</script>";
$durum="Yeniden oyna";
$db= new PDO("mysql:host=localhost;dbname=adam;charset=utf8","root","");
$say= $db->query("select count(*) as sayi  from sehircik",PDO::FETCH_ASSOC);
foreach($say as $snc)
$limit=$snc[sayi];
$kelime=$snc[sehirad];
$rast=rand(1,$limit);
};




//for($i=0;$i<$uzunluk;$i++)
//echo "<input type='text' maxlength=1 style='width:25px;height:30px;font-size:20px' name='harf$i'>";
echo "<input type='text' style='visibility:hidden' name='kelime' value=$kelime>";

echo "<input type='number' name='skor' value=$can style='width:50px;height:30px;font-size:20px'>";

echo "<br><input type='submit' value=$durum>";
//echo substr($kelime,0,$uzunluk);
echo "</form>";


?>