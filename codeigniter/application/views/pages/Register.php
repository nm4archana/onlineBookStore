<html>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/style.css">
<head><title>Registration</title></head>
   <div align = "center">
         <div id="div1" align = "left">
            <div id="div2"><b>Registration</b></div>
            <div id="div3">
<form method="post" action="<?php echo base_url(); ?>Pages/register">
  <label id="reg">Enter username: </label>
  <input type="text" name="username" placeholder="Enter userame"/><br/><br/>
  <label id="reg">Enter password: </label>
  <input type="text" name="password" placeholder="Enter password"/><br/><br/>
  <label id="reg">Enter Address:&nbsp&nbsp</label>
  <input type="text" name="address" placeholder="Enter address"/><br/><br/>
  <label id="reg">Enter Phone:&nbsp&nbsp&nbsp&nbsp&nbsp</label>
  <input type="text" name="phone" placeholder="Enter phone number"/><br/><br/>
  <label id="reg">Enter Email Id:&nbsp&nbsp</label>
  <input type="text" name="email" placeholder="Enter email"/><br/><br/>
  <div align="center">
  <input id="bOne"type="submit" name="submit1" value="Register"/>
 </div></div>
 </div></div>
 </form> 
