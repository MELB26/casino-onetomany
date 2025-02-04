<?php require_once 'core/dbConfig.php'; ?>
<?php require_once 'core/models.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Casino</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<h1>CASINO MANAGEMENT</h1>
	<form action="core/handleForms.php" method="POST">
		<p>
			<label for="casino_cat">Select a Casino</label> 
			<select name="casino_cat" id="casino_cat" required onchange="toggleCustomInput()">
				<option value="">Select</option>
				<option value="Super Casino">Super Casino</option>
				<option value="Dream Casino">Dream Casino</option>
				<option value="WIN Casino">WIN Casino</option>
				<option value="MEGA Casino">MEGA Casino</option>
				<option value="PAGCOR Casino">PAGCOR Casino</option>
				<option value="Other">Other</option>
			</select>
			
			<input type="submit" name="insertBusinessCategory" value="Submit">
		</p>
	</form>

	<script>
	function toggleCustomInput() {
		var casinoSelect = document.getElementById("casino_cat");
		var customInput = document.getElementById("custom_casino");

		// Show the custom input only if "Other" is selected
		if (casinoSelect.value === "Other") {
			customInput.style.display = "inline-block";
			customInput.required = true; // Make it required when visible
		} else {
			customInput.style.display = "none";
			customInput.required = false; // Remove required when hidden
			customInput.value = ""; // Clear the custom input field
		}
	}
	</script>


	
    <?php $getAllbusiness_category =  getAllbusiness_category($pdo)?>

	<?php foreach ($getAllbusiness_category as $row) { ?>
	<div class="container" style="border-style: solid; width: 50%; height: 120px; margin-top: 20px; padding-left: 10px;">
		<h3>Casino ID: <?php echo $row['casino_cat_id']; ?></h3>
		<h3>Casino: <?php echo $row['casino_cat']; ?></h3>
		<a href="viewbusiness.php?casino_cat_id=<?php echo $row['casino_cat_id']; ?>">View Casino</a>
		<a href="editcasino.php?casino_cat_id=<?php echo $row['casino_cat_id']; ?>">Edit</a>
		<a href="deletecasino.php?casino_cat_id=<?php echo $row['casino_cat_id']; ?>">Delete</a>


	</div> 
	<?php } ?>



</body>
</html>