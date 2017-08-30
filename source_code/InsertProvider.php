<?php
 session_start();
	if (empty($_SESSION['user'])) {
		header("Location: index.php");
	}
	require 'Connect_DB.php';

	//$IP = getHostByName(getHostName());

	//echo $IP;

	$v_ProviderID = $_POST["v_ProviderID"];
	$v_ProviderName = $_POST["v_ProviderName"];
	$v_ProviderDescription = $_POST["v_ProviderDescription"];
	$v_ProviderWebsite = $_POST["v_ProviderWebsite"];

	$v_ProviderAddress = $_POST["v_ProviderAddress"];
	$v_ProviderPhone = $_POST["v_ProviderPhone"];


	$v_ProviderFax = $_POST["v_ProviderFax"];
	$v_ProviderContactName = $_POST["v_ProviderContactName"];
	$v_ProviderContactMobilePhone = $_POST["v_ProviderContactMobilePhone"];
	$v_ProviderContactEmail = $_POST["v_ProviderContactEmail"];


	$v_ProviderWayOfOrdering = $_POST["v_ProviderWayOfOrdering"];
	$v_ProviderWayOfPicking = $_POST["v_ProviderWayOfPicking"];
	$v_ProviderDeliveryTerms = $_POST["v_ProviderDeliveryTerms"];
	$v_ProviderMinimumDeliveryNumber = $_POST["v_ProviderMinimumDeliveryNumber"];
	$v_ProviderMinimumPreparationTime = $_POST["v_ProviderMinimumPreparationTime"];
	

	$v_ProviderIsSpecified = $_POST["v_ProviderIsSpecified"];
	$v_ProviderVATNumber = $_POST["v_ProviderVATNumber"];
	$v_ProviderRegistrationNumber = $_POST["v_ProviderRegistrationNumber"];
	$v_ProviderPrincipalName = $_POST["v_ProviderPrincipalName"];
	$v_ProviderReceiptType = $_POST["v_ProviderReceiptType"];
	$v_ProviderPaymentTerms = $_POST["v_ProviderPaymentTerms"];
	
	$v_ProviderRemittingAccount = $_POST["v_ProviderRemittingAccount"];
	$v_ProviderRemark = $_POST["v_ProviderRemark"];
	$v_ProviderIsEffective = $_POST["v_ProviderIsEffective"];


$sql = 'INSERT INTO "t_Providers"(
            "c_ProviderID", "c_ProviderName", "c_ProviderDescription", "c_ProviderWebsite", 
            "c_ProviderAddress", "c_ProviderPhone", "c_ProviderFax", "c_ProviderContactName", 
            "c_ProviderContactMobilePhone", "c_ProviderContactEmail", "c_ProviderWayOfOrdering", 
            "c_ProviderWayOfPicking", "c_ProviderDeliveryTerms", "c_ProviderMinimumDeliveryNumber", 
            "c_ProviderMinimumPreparationTime", "c_ProviderIsSpecified", 
            "c_ProviderVATNumber", "c_ProviderRegistrationNumber", "c_ProviderPrincipalName", 
            "c_ProviderReceiptType", "c_ProviderPaymentTerms", "c_ProviderRemittingAccount", 
            "c_ProviderRemark", "c_ProviderIsEffective", "c_ProviderCreationDateTime", 
            "c_ProviderLatestModifyDateTime")
    VALUES (\''.$v_ProviderID.'\', \''.$v_ProviderName.'\', NULL, NULL, 
            \''.$v_ProviderAddress.'\', \''.$v_ProviderPhone.'\', \''.$v_ProviderFax.'\', \''.$v_ProviderContactName.'\', 
            \''.$v_ProviderContactMobilePhone.'\', \''.$v_ProviderContactEmail.'\', \''.$v_ProviderWayOfOrdering.'\', 
            \''.$v_ProviderWayOfPicking.'\', \''.$v_ProviderDeliveryTerms.'\', '.$v_ProviderMinimumDeliveryNumber.', 
            '.$v_ProviderMinimumPreparationTime.', '.$v_ProviderIsSpecified.', 
            \''.$v_ProviderVATNumber.'\', \''.$v_ProviderRegistrationNumber.'\', \''.$v_ProviderPrincipalName.'\', 
            \''.$v_ProviderReceiptType.'\', \''.$v_ProviderPaymentTerms.'\', \''.$v_ProviderRemittingAccount.'\', 
            NULL, '.$v_ProviderIsEffective.', CURRENT_TIMESTAMP, 
            CURRENT_TIMESTAMP);';

//echo $sql;

try
{
	$statement = $connection->exec($sql);
}
catch (PDOException $e)
{
    echo 'INSERT PROVIDER FAILED: ' . $e->getMessage();
}

//echo 'Finish';

	}


?>
