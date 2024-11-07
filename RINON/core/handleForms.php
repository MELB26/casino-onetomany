

<?php 
require_once 'dbConfig.php'; 
require_once 'models.php';



if (isset($_POST['insertBusinessCategory'])) {
	$casino_name = ($_POST['casino_cat'] === 'Other') ? $_POST['custom_casino'] : $_POST['casino_cat'];
    $business_category = trim($_POST['casino_cat']);
    if (!empty($business_category)) {
        $query = insertNewCategory($pdo, $business_category);

        if ($query) {
            header("Location: ../index.php");
            exit();
        } else {
            echo "Insert failed. Please try again.";
        }
    } else {
        echo "Make sure that all fields are filled.";
    }
};



if (isset($_POST['insertBusinessDetails'])) {
    $businessOwner = trim($_POST['customer_name']);
    $businessName = trim($_POST['date_added']);
    $branch = trim($_POST['business_branch']);
    $categoryId = trim($_POST['business_category']); 

    if (!empty($businessOwner) && !empty($businessName) && !empty($branch) && !empty($categoryId)) {
      
        $query = insertIntoUsersRecords($pdo, $businessOwner, $businessName, $branch, $categoryId);

        if ($query) {
            header("Location: ../index.php");
            exit();
        } else {
            echo "Insert failed. Please try again.";
        }
    } else {
        echo "Make sure that all fields are filled.";
    }
};

if (isset($_POST['editDetails'])) {
	$query = updateProject($pdo, $_POST['customer_name'], $_POST['Branch'], $_GET['customer_id']);

	if ($query) {
		header("Location: ../viewbusiness.php?casino_cat_id=".$_GET['casino_cat_id']);
	}
	else {
		echo "Update failed";
	}

}


if (isset($_POST['deletebusiness'])) {
	$query = deletebusiness($pdo, $_GET['customer_id']);

	if ($query) {
		header("Location: ../viewbusiness.php?casino_cat_id=".$_GET['casino_cat_id']);
	}
	else {
		echo "Deletion failed";
	}
}



if (isset($_POST['editCategory'])) {
	$query = updateCategory($pdo, $_POST['casino_cat'], $_GET['casino_cat_id']);

	if ($query) {
		header("Location: ../index.php");
	}

	else {
		echo "Update failed";;
	}

}


if (isset($_POST['deleteCategory'])) {
	$query = deleteCategory($pdo, $_GET['casino_cat_id']);

	if ($query) {
		header("Location: ../index.php");
	}

	else {
		echo "Delete failed";;
	}

}

?>