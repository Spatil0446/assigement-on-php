<?php
require_once "db.php";
if(isset($_SESSION['user_id'])!="") {
header("Location: dashboard.php");
}
$msg = '';
  
if (isset($_POST['signup'])) {
	
		
	$var1 = rand(1111,9999);  // generate random number in $var1 variable
    $var2 = rand(1111,9999);  // generate random number in $var2 variable
	
    $var3 = $var1.$var2;  // concatenate $var1 and $var2 in $var3
    $var3 = md5($var3);   // convert $var3 using md5 function and generate 32 characters hex number

    $fnm = $_FILES["image"]["name"];    // get the image name in $fnm variable
    $dst = $fnm;  // storing image path into the {all_images} folder with 32 characters hex number and file name
    $dst_db = $fnm; // storing image path into the database with 32 characters hex number and file name

    move_uploaded_file($_FILES["image"]["tmp_name"],$dst);  // move image into the {all_images} folder with 32 characters hex number and image name
	
$name = mysqli_real_escape_string($conn, $_POST['name']);
$category = mysqli_real_escape_string($conn, $_POST['category']);
$description = mysqli_real_escape_string($conn, $_POST['description']);
$expectancy = mysqli_real_escape_string($conn, $_POST['expectancy']);
$image=$dst; 
$curdate=date("d/m/Y");
echo $image;
echo $curdate;

//$image = mysqli_real_escape_string($conn, $_POST['image']);
if (!$error) {
if(mysqli_query($conn, "INSERT INTO tblaminal(name, category, description ,expectancy,image,entrydate) VALUES('" . $name . "', '" . $category . "', '" . $description . "','" . $expectancy . "', '" . $image. "',now())")) {
header("location: animal.php");
exit();
} else {
echo "Error: " . $sql . "" . mysqli_error($conn);
}
}
mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Submit Animal Form</title>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
<div class="row">
<div class="col-lg-8 col-offset-2">
<div class="page-header">
<h2>Submit Animal Form</h2>
</div>
<p>Please fill all fields in the form</p>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
<label>Name</label> 
<div class="form-group col-6">
<input type="text" name="name" class="form-control" value="" maxlength="50" required="">

</div>
<div class="form-group ">
<label>Category</label><br/>
<div class="form-group col-6">
  <div class="custom-control custom-radio custom-control-inline">
       <input type="radio" id="herbi" name="category" value="Herbivores" class="custom-control-input">
       <label class="custom-control-label" for="herbi">Herbivores</label>
   </div>
 <div class="custom-control custom-radio custom-control-inline">
     <input type="radio" id="omini" name="category" value="Omnivores" class="custom-control-input">
     <label class="custom-control-label" for="omini">Omnivores</label>
     </div>
	 <div class="custom-control custom-radio custom-control-inline">
	
     <input type="radio" id="carni" name="category" value="Carnivores" class="custom-control-input">
     <label class="custom-control-label" for="carni">Carnivores</label>
     </div>

 </div>

</div>
<label>File Upload</label>
<div class="form-group col-6">
 <input type="file" name="image">

</div>

<label>Description</label>
<div class="form-group col-6">


<textarea class="form-control" name="description" id="description" rows="4"></textarea>

</div>
<label>Life Expectancy</label>
<div class="form-group col-6">

 
            <select id="expectancy" name="expectancy" class="form-control">
                <option selected="" disabled>Years</option>
                <option value="0-1">0-1 Years</option>
                <option value="1-5">1-5 Years</option>
				<option value="5-10">5-10 Years</option>
				<option value="10+">10+ Years</option>
            </select>
        

</div>  
<div class="form-group">
<label>Enter Captcha</label>
<div class="form-group col-6">
     <input type="text" name="captcha" class="form-control" value="" maxlength="50" required="">      

<p><br />
<img src="captcha.php?rand=<?php echo rand(); ?>" id='captcha_image'>

</p>
<p>Can't read the image?
<a href='javascript: refreshCaptcha();'>click here</a>
to refresh</p>
</div>
<input type="submit" class="btn btn-primary" name="signup" value="submit">
Already have a account?<a href="login.php" class="btn btn-default">Login</a>
</form>
</div>
</div>    
</div>
</body>
</html>