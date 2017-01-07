<?php
class books_models extends CI_Model 
{

        public function __construct()
        {
                $this->load->database();
        }


public function can_login($username,$password)
{

       $this->db->where('username',$username);
       $this->db->where('password',$password);
       $query = $this->db->get('customer');

       if($query->num_rows()>0)
       {
       		return true;
       }
       else
       {
       		return false;
       }
		
}

public function register($userinfo)
{
    $this->db->insert('customer',$userinfo);
}

public function searchByTitle($searchText)
{
  $this->db->select('book.title,book.isbn,sum(stocks.number) as no');
  $this->db->from('stocks');
  $this->db->join('book', 'book.isbn = stocks.isbn');
  $this->db->like('book.title',$searchText);
  $this->db->group_by('book.isbn');
  $query = $this->db->get();
    if($query->num_rows() > 0)
    {
      foreach ($query->result() as $row)
      {
        $data[] = $row;
      }
      return $data;
    }
}


public function searchByAuthor($searchText)
{
  $this->db->select('book.title,book.isbn,sum(stocks.number) as no');
  $this->db->from('author');
  $this->db->join('writtenby', 'author.ssn = writtenby.ssn');
  $this->db->join('book', 'book.isbn = writtenby.isbn');
  $this->db->join('stocks','stocks.isbn=book.isbn');
  $this->db->like('author.name',$searchText);
  $this->db->group_by('book.isbn');
  $query = $this->db->get();
    if($query->num_rows() > 0)
    {
      foreach ($query->result() as $row)
      {
        $data[] = $row;
      }
      return $data;
    }
}

public function buy()
{
  $this->db->select('basketId');
  $this->db->from('shoppingbasket');  
  $this->db->order_by('basketid', 'desc');
  $this->db->limit(1);
  $query = $this->db->get();
  
  if($query->num_rows() > 0)
    {
      foreach ($query->result() as $row)
      {
         $basketid = $row->basketId;
      }
    }
    foreach ($_SESSION['shoppingbasketFin'] as $var ) 
    {
      $isbn = $var['isbn'];
      $number = $var['quantity'];    
     

        $dataArray = array('isbn'=>$isbn,'basketId'=>$basketid,'number'=>$number);
        $this->db->insert('contains',$dataArray);

        $this->db->select('stocks.warehouseCode,stocks.number');
        $this->db->from('stocks');  
        $this->db->where('isbn',$isbn);
        $query = $this->db->get();
         $count = $var['quantity']; 
         $username = $_SESSION['username'];
        if($query->num_rows() > 0)
         {
           foreach ($query->result() as $row1)
             {
              if(!($number<$stocknum||$count<0))
              {
                $warehouseCode =  $row1->warehouseCode;
                 $stocknum = $row1->number;
                  
              if($count<$stocknum)
              {
              $shipArray = array('isbn'=>$isbn,'warehouseCode'=>$warehouseCode,'username'=>$username,'number'=>$count);
              $this->db->insert('shippingorder',$shipArray);

              $upcount = $stocknum-$count;

              $updateStArr = array('number'=>$upcount);
              $updateWerArr = array('isbn'=>$isbn,'warehouseCode'=>$warehouseCode);
              $this->db->update('stocks',$updateStArr);
              $this->db->where($updateWerArr);
              }
              else
              {
              $shipArray = array('isbn'=>$isbn,'warehouseCode'=>$warehouseCode,'username'=>$username,'number'=>$stocknum);
              $this->db->insert('shippingorder',$shipArray);

              $shipDelArray = array('isbn'=>$isbn,'warehouseCode'=>$warehouseCode);
              $this->db->where($shipDelArray);
              $this->db->delete('stocks');         
              }

              $count = $count - $stocknum;
              } 
         } 

       } }  } 

public function shoppingSession($isbn)
{
$this->db->select('book.title,book.price,author.name,sum(stocks.number) as no');
$this->db->from('book');
$this->db->join('writtenby', 'book.isbn = writtenby.isbn');
$this->db->join('author', 'writtenby.ssn = author.ssn');
$this->db->join('stocks', 'stocks.isbn = book.isbn');
$this->db->where('book.isbn',$isbn) ;
$query = $this->db->get();
return $query;
}

public function createBasketId($basketinfo)
{
  
   $this->db->insert('shoppingbasket',$basketinfo);

}

public function can_register($username)
{
       $this->db->where('username',$username);
       $query = $this->db->get('customer');

       if($query->num_rows()>0)
       {
          return false;
       }
       else
       {
          return true;
       }
    
}}