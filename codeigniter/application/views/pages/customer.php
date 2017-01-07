
<html>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/style.css">
<head><title>Customer </title></head>
   <div align = "center">
         <div id="div1" align = "left">
            <div id="div2"><b>Login</b></div>
            <div id="div3" >

<form method="post" action="<?php echo base_url(); ?>Pages/login_validation">
  <label>UserName: </label>
  <input type="text" name="username" placeholder="Enter userame"/><br/><br/>
  <label>Password: </label>
  <input type="password" name="password" placeholder="Enter password"/><br/><br/>
  <div align="center">
  <input id="bOne"type="submit" name="submit" value="Login" />
  <input id="bTwo" type="submit" name="submit" value="New Users must register here" />
 </div></div>
 </div></div>
 </form> 