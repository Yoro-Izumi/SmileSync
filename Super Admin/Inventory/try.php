
<?php
session_start();
include '../admin_global_files/connect_database.php';
$connect_inventory = connect_inventory($servername,$username,$password);

$qryGetItemCategories = "SELECT * FROM smilesync_inventory_categories";
$stmtGetItemCategories = $connect_inventory->prepare($qryGetItemCategories);
$stmtGetItemCategories->execute();
$resultGetItemCategories = $stmtGetItemCategories->get_result();

$currentDate = date('Y-m-d');
$conn = connect_inventory($servername, $username, $password);

?>


<form id="addItemForm" name="addItemForm" class="modal-form" action="try.php" method="POST">
 <div class="modal-content">
        <b class="modal-title normal-title">New Order</b>

        <div class="message-container">
            <div class="wrap-2rows">
                <div class="input-wrap">
                    <input class="modal-input" type="text" maxlength="24" autocomplete="off" name="ProductName" required />
                <label>Product Name<indicator>*</indicator></label>
                </div>
                <div class="input-wrap">
                   <!-- <input  class="modal-input" class="modal-input" type="text" maxlength="24" autocomplete="off" name="ProductType" required /-->
                   <select name="ProductType">
                        <option value="NULL">Select Product Type</option>
                        <?php
                        while($row = $resultGetItemCategories->fetch_assoc()) {
                            echo '<option value="'.$row['category_id'].'">'.$row['category_name'].'</option>';
                        }
                        $stmtGetItemCategories->close();
                        ?>
                    </select>
                <label>Product Type<indicator>*</indicator></label>
                </div>
            </div>

            <div class="wrap-2rows">
                <div class="input-wrap">
                    <input class="modal-input" type="number" maxlength="11" autocomplete="off" name="ProductQuantity" required />
                <label>Product Quantity<indicator>*</indicator></label>
                </div>
                <div class="input-wrap">
                    <input class="modal-input" type="date" autocomplete="off" name="BatchDate" required />
                <label>Batch Date<indicator>*</indicator></label>
                </div>
            </div>

            <div class="wrap-2rows">
                <div class="input-wrap">
                    <input class="modal-input" type="text" maxlength="11" autocomplete="off" name="OrderValue" placeholder="00.00" required />
                <label>Order Value<indicator>*</indicator></label>
                </div>
                <div class="input-wrap">
                    <input class="modal-input" type="text" maxlength="11" autocomplete="off" name="BuyingPrice" placeholder="00.00" required />
                <label>Buying Price<indicator>*</indicator></label>
                </div>
            </div>

            <div class="wrap-2rows">
                <div class="input-wrap">
                    <input class="modal-input" type="text" maxlength="24" autocomplete="off" name="ProductBrand" required />
                <label>Product Brand<indicator>*</indicator></label>
                </div>
                <div class="input-wrap">
                    <input class="modal-input" type="date" maxlength="24" autocomplete="off" name="ExpiryDate" required />
                <label>Expiry Date<indicator>*</indicator></label>
                </div>
            </div>
        </div>
        <button type="submit" id="addItemBtn" class="modal-button success">Add</button>
        <button class="modal-button secondary-button warning" id="cancelAddItemBtn">Cancel</button>
    </div>

</form>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#addItemForm').on('submit', function(event) {
            event.preventDefault(); // Prevent default form submission

            const formData = $(this).serialize(); // Serialize form data

            $.ajax({
                url: 'modal_crud/inventory_add.php',
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        alert(response.message);
                        $('#addItemForm')[0].reset(); // Clear the form
                    } else {
                        alert('Error: ' + response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', status, error);
                }
            });
        });
    });
</script>