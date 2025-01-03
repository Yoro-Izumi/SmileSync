<?php
$connect_appointment = connect_appointment($servername, $username, $password);
$service_status = "Available";

// Prepare and execute the query
$stmtServiceListing = "SELECT * FROM smilesync_services WHERE service_status = ?";
$prepareServiceListing = mysqli_prepare($connect_appointment, $stmtServiceListing);
mysqli_stmt_bind_param($prepareServiceListing, "s", $service_status);
mysqli_stmt_execute($prepareServiceListing);
$resultsServiceListing = mysqli_stmt_get_result($prepareServiceListing);

// Check if results are returned
if ($resultsServiceListing) {
    while ($service = mysqli_fetch_assoc($resultsServiceListing)) {
        // Fetch necessary data
        $serviceDescription = $service['service_description'] ?? "No Description";
        $serviceID = $service['service_id'];
        $servicePrice = $service['service_price'] ?? "0.00";
        $serviceDuration = $service['service_duration']." minute/s" ?? "Unknown";
?>

        <tr>
            <td><input type="checkbox" value="<?php echo $serviceID; ?>"></td>
            <td data-label="Description"><?php echo $serviceDescription; ?></td>
            <td data-label="ID"><?php echo $serviceID; ?></td>
            <td data-label="Price"><?php echo number_format($servicePrice, 2); ?></td>
            <td data-label="Duration"><?php echo $serviceDuration; ?></td>
            <td data-label="ACTIONS">
                <div class="actions">
                    <div class="dropdown">
                        <button>⋮</button>
                        <div class="dropdown-content">
                            <a href="#" class="removeServiceTable" data-modal="removeServicesModal" data-id="<?php echo $serviceID; ?>">Delete Service</a>
                            <a href="#" class="editServiceTable" data-modal="removeServicesModal" data-id="<?php echo $serviceID; ?>">Edit Service</a>
                        </div>
                    </div>
                </div>
            </td>
        </tr>

<?php
    }
}

// Close the database connection
mysqli_close($connect_appointment);
?>
