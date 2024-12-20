<?php
$connect_inventory = connect_inventory($servername, $username, $password);

// Assume $connect_inventory is the correct connection for your inventory database
$stmtInventoryContentID = mysqli_prepare($connect_inventory, "SELECT item_id FROM smilesync_inventory_items");
mysqli_stmt_execute($stmtInventoryContentID);
$resultInventoryContentID = mysqli_stmt_get_result($stmtInventoryContentID);

// Loop through each item_id retrieved
foreach ($resultInventoryContentID as $inventoryContentIDRow) {
    $inventoryContentID = $inventoryContentIDRow['item_id']; // Extract item_id

    // Query to get the full content of the inventory item (item name, quantity, etc.)
    $stmtInventoryContent = "SELECT * FROM smilesync_inventory_items WHERE item_id = ?";
    $prepareInventoryContent = mysqli_prepare($connect_inventory, $stmtInventoryContent);
    mysqli_stmt_bind_param($prepareInventoryContent, "i", $inventoryContentID);
    mysqli_stmt_execute($prepareInventoryContent);
    $resultInventoryContent = mysqli_stmt_get_result($prepareInventoryContent);

    // Fetch the inventory content details (e.g., initial quantity)
    if ($inventoryContent = mysqli_fetch_assoc($resultInventoryContent)) {
        $initialInventoryQuantity = $inventoryContent['item_quantity']; // Get total inventory quantity

        // Query to get the last usage date for the item
        $stmtLastUsage = "SELECT MAX(DATE(date_of_usage)) AS last_usage_date FROM smilesync_inventory_usage WHERE item_id = ?";
        $prepareLastUsage = mysqli_prepare($connect_inventory, $stmtLastUsage);
        mysqli_stmt_bind_param($prepareLastUsage, "i", $inventoryContentID);
        mysqli_stmt_execute($prepareLastUsage);
        $resultLastUsage = mysqli_stmt_get_result($prepareLastUsage);
        $lastUsageDateRow = mysqli_fetch_assoc($resultLastUsage);
        $lastUsageDate = $lastUsageDateRow['last_usage_date'];

        // If there's no usage date, skip to the next item
        if (!$lastUsageDate) {
            continue;
        }

        // Prepare an array to hold the dates for the last usage date and the past six days
        $dates = [];
        for ($i = 0; $i < 7; $i++) {
            $dates[$i] = date('Y-m-d', strtotime("$lastUsageDate -$i days")); // Store the last usage date and past 6 days
        }

        // Initialize an array to hold remaining quantities for the past 7 days (starting from last usage date)
        $remainingQuantities = array_fill(0, 7, 0); // Initialize with zeros

        // Loop through each date (from last usage date to past 6 days)
        foreach ($dates as $index => $date) {
            // Query to get the usage for this item on this particular date
            $stmtUsage = "SELECT quantity_used FROM smilesync_inventory_usage WHERE item_id = ? AND DATE(date_of_usage) = ?";
            $prepareUsage = mysqli_prepare($connect_inventory, $stmtUsage);
            mysqli_stmt_bind_param($prepareUsage, "is", $inventoryContentID, $date);
            mysqli_stmt_execute($prepareUsage);
            $resultUsage = mysqli_stmt_get_result($prepareUsage);

            // Fetch the usage amount (if any) for this date
            $usageAmount = 0;
            if ($usageData = mysqli_fetch_assoc($resultUsage)) {
                $usageAmount = $usageData['quantity_used']; // Get the number of items used on this date
            }

            // Calculate the remaining quantity for this date (initial quantity minus total usage up to this date)
            if ($index === 0) {
                // For the last usage date, subtract today's usage from the initial quantity
                $remainingQuantities[$index] = $initialInventoryQuantity - $usageAmount;
            } else {
                // For previous days, subtract cumulative usage
                $remainingQuantities[$index] = $remainingQuantities[$index - 1] - $usageAmount;
            }
        }

        // Display the rows for the inventory item
        echo "<tr>
                <td data-label='ID'>$inventoryContentID</td>
                <td data-label='Name'>{$inventoryContent['item_name']}</td>
                <td data-label='Date 1'>{$remainingQuantities[0]}</td> <!-- Last usage date -->
                <td data-label='Date 2'>{$remainingQuantities[1]}</td> <!-- 1 day ago -->
                <td data-label='Date 3'>{$remainingQuantities[2]}</td> <!-- 2 days ago -->
                <td data-label='Date 4'>{$remainingQuantities[3]}</td> <!-- 3 days ago -->
                <td data-label='Date 5'>{$remainingQuantities[4]}</td> <!-- 4 days ago -->
                <td data-label='Date 6'>{$remainingQuantities[5]}</td> <!-- 5 days ago -->
                <td data-label='Date 7'>{$remainingQuantities[6]}</td> <!-- 6 days ago -->
              </tr>";
    }
}
?>
