<?php



function insertIntoUsersRecords($pdo, $businessOwner, $businessName, $branch, $categoryId){
    $sql = "INSERT INTO casino_details (customer_name, date_added, Branch, 
		casino_cat_id) VALUES(?,?,?,?)";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$businessOwner, $businessName, $branch, 
		$categoryId]);

	if ($executeQuery) {
		return true;
	}

} 


function insertNewCategory($pdo, $business_category){
    $sql = "INSERT INTO casino (casino_cat) VALUES(?)";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$business_category]);

	if ($executeQuery) {
		return true;
	}

}




function getBusinessCategories($pdo) {
    $sql = "SELECT * FROM casino";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
}


function getAllbusiness_category($pdo) {
	$sql = "SELECT * FROM casino";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute();

	if ($executeQuery) {
		return $stmt->fetchAll();
	}
}
function getcasino_details($pdo, $casino_cat_id) {
    $sql = "SELECT 
                casino_details.customer_id AS `customer_id`,
                casino_details.customer_name AS `customer_name`,
                casino_details.date_added AS `date_added`,
                casino_details.Branch AS `Branch`,
                casino_details.casino_cat_id AS `casino_cat_id`,
                casino.casino_cat AS `casino_cat`
            FROM casino_details
            JOIN casino ON casino_details.casino_cat_id = casino.casino_cat_id
            WHERE casino_details.casino_cat_id = ? 
            ";

    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$casino_cat_id]);

    if ($executeQuery) {
        return $stmt->fetchAll(); 
    }
    return []; 
}
function getBusinessbyId($pdo, $customer_id) {
    $sql = "SELECT 
                casino_details.customer_id AS customer_id,
                casino_details.customer_name AS customer_name,
                casino_details.date_added AS date_added,
                casino_details.Branch AS Branch,
                casino.casino_cat AS Business_Category
            FROM casino_details
            JOIN casino ON casino.casino_cat_id = casino_details.casino_cat_id
            WHERE casino_details.customer_id = ? 
            GROUP BY casino_details.date_added";

    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$customer_id]);
    if ($executeQuery) {
        return $stmt->fetch();
    }
    return null; 
}


function updateProject($pdo, $customer_name,$Branch, $customer_id){
        $sql = "UPDATE casino_details
        SET customer_name = ?,
        Branch =?
        WHERE customer_id = ?
        ";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$customer_name,$Branch, $customer_id]);

    if ($executeQuery) {
    return true;
    }
}


function deletebusiness($pdo, $customer_id){
    $sql = "DELETE FROM casino_details WHERE customer_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$customer_id]);
	if ($executeQuery) {
		return true;
	}
}

function getBusinessCategory($pdo,$casino_cat_id){
    $sql = "SELECT * FROM casino WHERE casino_cat_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$casino_cat_id]);

	if ($executeQuery) {
		return $stmt->fetch();
	}
}

function updateCategory($pdo, $casino_cat, $casino_cat_id){
    $sql = "UPDATE casino
				SET casino_cat = ?
				WHERE casino_cat_id = ?
			";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$casino_cat, $casino_cat_id ]);
	
	if ($executeQuery) {
		return true;
	}
    
    
}
function deleteCategory($pdo,$casino_cat_id){
    $sql = "DELETE FROM casino WHERE casino_cat_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$casino_cat_id]);
	if ($executeQuery) {
		return true;
	}
}

?>