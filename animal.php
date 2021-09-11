<html>
<body>
<h1>All Records</h1> 
<label>Visitor Count:  </label>
<b><label id="CounterVisitor"></label></b>
</br></br>
<table border="2">
  <tr>
    
    <th>SrNo</th>
    <th>Name</th>
	<th>Category</th>
    <th>Description</th>
	<th>Life Expectancy</th>
    <th>Photo</th>
  </tr>

<?php
include "db.php";
$records = mysqli_query($conn,"select * from tblaminal order by Id desc"); // fetch data from database

while($data = mysqli_fetch_array($records))
{
?>
  <tr>
    
    <td><?php echo $data['Id']; ?></td>
	<td><?php echo $data['Name']; ?></td>
	<td><?php echo $data['Category']; ?></td>
	<td><?php echo $data['Description']; ?></td>
	<td><?php echo $data['Expectancy']; ?></td>
    <td><img src="<?php echo $data['Image']; ?>" width="50" height="50"></td>
  </tr>	
<?php
}
?>

</table>

<script>

var n = localStorage.getItem('on_load_counter');

    if (n === null) {
        n = 0;
    }

    n++;

    localStorage.setItem("on_load_counter", n);

    document.getElementById('CounterVisitor').innerHTML = n;
</script>

<?php mysqli_close($conn);  // close connection ?>

</body>
</html>