<?
// ----------------------------конфигурация-------------------------- //

header("Content-Type: text/html; charset=utf-8");

$adminemail="knitteddresses1@yandex.ru";  // e-mail админа


$date=date("d.m.y"); // число.месяц.год

$time=date("H:i"); // часы:минуты:секунды

$backurl="http://http://viazzanka.ru/index.html";  // На какую страничку переходит после отправки письма

//---------------------------------------------------------------------- //



// Принимаем данные с формы

$name=$_POST['name'];

$email=$_POST['mail'];

$tel=$_POST['telephone'];



// Проверяем валидность e-mail

if (!preg_match("|^([a-z0-9_\.\-]{1,20})@([a-z0-9\.\-]{1,20})\.([a-z]{2,4})|is",
strtolower($email)))

 {

  echo
"<center>Вернитесь <a
href='javascript:history.back(1)'><B>назад</B></a>. Вы
указали неверные данные!";

  }

 else

 {


$msg="


<p>Имя: $name</p>

<p>телефон: $tel</p>

<p>E-mail: $email</p>



";



 // Отправляем письмо админу

mail("$adminemail", "$date $time Сообщение от $name", "$msg");



// Сохраняем в базу данных

$f = fopen("message.txt", "a+");

fwrite($f," \n $date $time Сообщение от $name");

fwrite($f,"\n $msg ");

fwrite($f,"\n ---------------");

fclose($f);



// Выводим сообщение пользователю

print "<script language='Javascript'><!--
function reload() {location = \"$backurl\"}; setTimeout('reload()', 1000);
//--></script>

$msg

<p>Ваше сообщение отправлено! Мы перезвоним вам в течении 15 мин! Спасибо</p>";
exit;

 }

?>
