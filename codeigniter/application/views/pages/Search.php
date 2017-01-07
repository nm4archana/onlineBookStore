<html>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/style.css">
<head>
  <title>Search</title>
 </head>
<body>
   <div align = "center">
         <div id="div1" align = "left">
            <div id="div2"><b>Search</b></div>
            <div id="div3">

  <form method="get" action="<?php echo base_url(); ?>Pages/search_result">
  <div align="center">
  <input type="text1" name="searchtext" placeholder="Enter text to be searched"/><br/><br/>
  <input id="bOne"type="submit" name="search" value="SearchByAuthor" />
  <input id="bTwo" type="submit" name="search" value="SearchByBookTitle" /></br></br>
  </div>
<div align = "center"></br>
   <input id="bFour" type="submit" name="search" value="Logout" />
</div>
  </form>
  </div></div>
  </br></br></br>
<?php if(isset($_SESSION['isSearch'])&&$_SESSION['isSearch']=='SearchByAuthor') {
	  if(!empty($books))
    {
      ?>
      <div align="center">
     <table id="table1">
      <tr>
      <th>BookName</th>
      <th>ISBN Number</th>
      <th>Number Of books Available</th>
      <th>Enter Quantity</th>
      <th>Click to Add To Cart</th>
      </tr> 
      <?php
      foreach($books as $book)
      {
        
      $searchtext = $_SESSION['searchText'];
      $title =   $book->title;
      $isbn = $book->isbn;
      $no = $book->no;
      ?>
      <tr>
      <td><?= $title ?></td>
      <td><?= $isbn ?></td>
      <td><?= $no ?></td>
     
      <form method="get" action="<?php echo base_url(); ?>Pages/addtocart">
      <td>
        <input type="text" name="quantity" id="<?=$isbn?>" />
      </td>
      <td>
      <input type="hidden" name="isbn" value="<?php echo $isbn; ?>"/>
      <input type="submit" id="<?=$isbn?>" name="addtocart" value="Add To Cart"></td> 
      </form>
      </tr>
      <?php
      }?>

       </table>
  </div>
  <?php
    }
}?>

<?php if(isset($_SESSION['isSearch'])&&$_SESSION['isSearch']=='SearchByBookTitle') {
  if(!empty($books))
    {
      ?>
      <div align="center">
     <table id="table1">
      <tr>
      <th>BookName</th>
      <th>ISBN Number</th>
      <th>Number Of books Available</th>
      <th>Enter Quantity</th>
      <th>Click to Add To Cart</th>
      </tr> 
      <?php
      foreach($books as $book)
      {
      $searchtext = $_SESSION['searchText'];
      $title =   $book->title;
      $isbn = $book->isbn;
      $no = $book->no;
?>

      <tr>
      <td><?= $title ?></td>
      <td><?= $isbn ?></td>
      <td><?= $no ?></td>
     
      <form method="get" action="<?php echo base_url(); ?>Pages/addtocart">
      <td>
        <input type="text" name="quantity" id="<?=$isbn?>" />
      </td>
      <td>
      <input type="hidden" name="isbn" value="<?php echo $isbn; ?>"/>
      <input type="submit" id="<?=$isbn?>" name="addtocart" value="Add To Cart"></td> 
      </form>
      </tr>
      <?php
      }?>

       </table>
  </div>
  <?php
    }
}?>
</br></br>
<form method="get" action="<?php echo base_url(); ?>Pages/buy">
<input id="bThree" type="submit" name="search" value="ShoppingBasket"/>  
<input id="text2" type="text" name="shoppingbas" value="<?php echo sizeof($_SESSION['shoppingbasketFin']);?>"/>
</form>
<div>
  </body>
  </html>