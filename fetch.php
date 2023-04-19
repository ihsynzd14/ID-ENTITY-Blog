<?php
//fetch.php
$connect = mysqli_connect("localhost", "root", "", "blog");
$output = '';
if(isset($_POST["query"]))
{
 $search = mysqli_real_escape_string($connect, $_POST["query"]);
 $query = "
  SELECT * FROM posts 
  WHERE title LIKE '%".$search."%'
  OR body LIKE '%".$search."%' 
 ";
}
else
{
 $query = "
  SELECT * FROM posts ORDER BY created_at
 ";
}
$result = mysqli_query($connect, $query);
if(mysqli_num_rows($result) > 0)
{
 $output .= '
  <div class="table-responsive">
   <table class="table table bordered">
    <tr>

     <th>Titolo del Post &nbsp;&nbsp;</th>
     
     <th>Data di Creazione&nbsp;&nbsp;</th>
     <th>Link</th>
    </tr>
 ';
 while($row = mysqli_fetch_array($result))
 {
  $output .= '
   <tr>
   <td><h2><a href="single.php?id='.$row['id'].'">'.$row['title'].'</a></h2> </td>
   <td><i class="far fa-calendar"> '.$row["created_at"].'</i> </td>
   <td><a href="single.php?id='.$row['id'].'" style="a.btn.read-more:hover:color:black">Leggi Tutto</a></td>
   </tr>
  ';
 }
 echo $output;
}
else
{
 echo '<h3>Non c"è nessun titolo o contenuto per la sua ricerca</h3>';
}

?>