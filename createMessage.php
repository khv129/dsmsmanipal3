<?php 
require 'core.inc.php';
require 'connect.inc.php'; 
require 'header.php';

if(!loggedin())
{
    header('Location: index.php');
}
?>
<div>
<form method="post" name="form" id="form">
Create general message <br />
<input id="gm" name="gm" value="Type your message" type="text" />
<div >
<input type="submit" value="Submit" class="submit"/>
<span class="error" style="display:none"> Please Enter Valid Data</span>
<span class="success" style="display:none"> Registration Successfully</span>
</div></form>
</div>
<div>
<form method="post" name="form" id="form">
Who's birthday?<br />
<input id ="bmsg" name="bmsg" type="text"/>
Event Date :<br /> 
<input id ="bdate" name="bdate" type="date"/>
<input type="submit" value="Submit" class="submit2">
</form>
</div>
<div>
<form name="form" method="post" id="form">
<input type="text" id="emsg" name="emsg"/>
<input type="text" id="eplace" name="eplace"/>
<div>
<label for="meeting">Event Date : </label><input name="edate" id="edate" type="date"/>
</div>
<div>
<label for="meeting">Event Time : </label> <input name="etime" id="etime"type="time"/>
</div>
<input type="submit" value="Submit" class="submit3">
</form>
</div>
<div>
Create Note
<form name="form" method="post" id="form">
<input type="text" name="note" id="note"/>
<input type="submit" value="Submit" class="submit4">
</form>
</div>

<div>
  Create Note
<form name="form" method="post">
<input type="text" name="impmsg" id="impmsg"/>
<?php
try
{
$tsql="SELECT * FROM People WHERE uid <>".$_SESSION['id'].";";
$stmt =$connHar->query($tsql); 
$periods=$stmt->fetchAll();
$num=count($periods);
if($num==0)
{}
else 
{
echo '<br />';
foreach($periods as $period)
{?>

<input type="checkbox" name="rid[]" value="<?php echo $period['uid']?>" /><?php echo $period['Name'].' '.$period['Lname'];?>
<br />
<?php }

//echo $name = sqlsrv_get_field( $stmt, 0);

}
}
catch(Exception $e)
{
die(print_r($e));
}
?>
<input type="submit" value="Submit" class="submit5">
</form>

</div>
 
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/
libs/jquery/1.3.0/jquery.min.js">
</script>
<script type="text/javascript" >
$(function() {
$(".submit").click(function() {
var name = $("#gm").val();

if(name=='')
{
$('.success').fadeOut(200).hide();
$('.error').fadeOut(200).show();
}
else
{
var str=$("form").serializeArray();
str.push({name: 'check', value: 1});
$.ajax({
type: 'post',
url: 'messageDBentry.php',
data: str,
success: function () {
alert('message was submitted');
}
});
}
return false;
});
$(".submit2").click(function() {
var name = $("#bmsg").val();

if(name=='')
{
}
else
{
var str2=document.getElementById("bdate");
str3=str2.value;
var str=$("form").serializeArray();
str.push({name: 'stro', value: str3});
str.push({name: 'check', value: 2});
//$("#results").text(str2);
$.ajax({
type: 'post',
url: 'messageDBentry.php',
data:str,
success: function () {
alert('<?php echo "birthday";?> was submitted');
}
});
}
return false;
});
$(".submit3").click(function() {
var name = $("#emsg").val();
//alert("hi");
if(name=='')
{
}
else
{
var str2=document.getElementById("edate");
var str3=str2.value;
var str4=document.getElementById("etime");
var str5=str4.value;
var str=$("form").serializeArray();
str.push({name: 'stro', value: str3});
str.push({name: 'stro2', value: str5});
str.push({name: 'check', value: 3});
//alert(str);
$.ajax({
type: 'post',
url: 'messageDBentry.php',
data: str,
success: function () {
alert(' event was submitted');
}
});
}
return false;
});
$(".submit4").click(function() {
var name = $("#note").val();

if(name=='')
{
}
else
{
var str=$("form").serializeArray();
str.push({name: 'check', value: 4});
$.ajax({
type: 'post',
url: 'messageDBentry.php',
data: str,
success: function () {
alert('note was submitted');
}
});
}
return false;
});


    $(".submit5").click(function() {
var name = $("#impmsg").val();

if(name=='')
{

}
else
{
var str=$("form").serializeArray();
str.push({name: 'check', value: 5});
$.ajax({
type: 'post',
url: 'messageDBentry.php',
data: str,
success: function () {
alert('important message was submitted');
}
});
}
return false;
});
});
</script>


