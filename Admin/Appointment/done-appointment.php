        <div class="content">
        <button class="close-btn"><a href="#" id="closeDone">&times;</a></button>
                    <h2>iMee-Toga Oli Dental Clinic</h2>
                    <p>788 Rizal Blvd. Poblacion Brgy. Market Area, Santa Rosa Laguna</p>
        <!-- Personal Information -->
        <div class="section-title">Personal Information</div>
        <div class="personal-info2">
            <div class="form-group2">
                <label>Patient Name:</label>
                <span>Dimaculangan, Chorlyn L.</span>
            </div>
            <div class="form-group2">
                <label>Phone Number:</label>
                <span>0912345678</span>
            </div>
        </div>
        <div class="personal-info2">
            <div class="form-group2">
                <label>Age:</label>
                <span>22</span>
            </div>
            <div class="form-group2">
                <label>Sex:</label>
                <span>Female</span>
            </div>
            <div class="form-group2">
                <label>Birth Date:</label>
                <span>01/03/2024</span>
            </div>
        </div>

        <div class="personal-info">
            <div class="form-group">
                <label>Address:</label>
                <input type="text" readonly value="Brgy. Sinalhan, Purok 7" />
            </div>
            <div class="form-group">
                <label>City:</label>
                <input type="text" readonly value="Santa Rosa City" />
            </div>
            <div class="form-group">
                <label>Province:</label>
                <input type="text" readonly value="Laguna" />
            </div>
        </div>
        <div class="personal-info">
            <div class="form-group">
                <label>Address:</label>
                <input type="text" readonly value="Brgy. Sinalhan, Purok 7" />
            </div>
            <div class="form-group">
                <label>Relationship:</label>
                <input type="text" readonly value="Grandmother" />
            </div>
            <div class="form-group">
                <label>Phone Number:</label>
                <input type="text" readonly value="09876543210" />
            </div>
        </div>
        <!-- Treatment Record -->
        <div class="treatment-record">
            <div class="section-title">Treatment Record</div>
            <div class="personal-info2">
                <div class="form-group">
                    <label>Date of Appointment:</label>
                    <input type="text" readonly value="29/03/2024" />
                </div>
                <div class="form-group">
                    <label>Procedure/s:</label>
                    <input type="text" readonly value="Prosthodontics" />
                </div>
                <div class="form-group">
                    <label>Dentist/s:</label>
                    <input type="text" readonly value="Dr.Oli, Jonas" />
                </div>
                <div class="form-group">
                    <label>No. of Tooth:</label>
                    <input type="text" readonly value="3" />
                </div>

            </div>
            <div class="form-group">
                <label>Consumed Products:</label>
                <div class="dropdown-container">
                    <button onclick="toggleDropdown()">Select Products</button>
                    <div class="dropdown-menu">
                        <label>
                            <input type="checkbox" value="Product A" data-name="Product A">
                            Product A
                            <input type="number" value="1" min="1" max="99" class="number-input">
                        </label>
                        <label>
                            <input type="checkbox" value="Product B" data-name="Product B">
                            Product B
                            <input type="number" value="1" min="1" max="99" class="number-input">
                        </label>
                    </div>
                </div>
            </div>

            <div class="selected-items"></div>
            <input type="hidden" id="selected-products" class="hidden-input" name="selected-products">
            <div class="form-group">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <!-- Left Side: Amount Charged, Amount Paid, Balance -->
                <div style="display: grid; grid-template-rows: auto auto auto; gap: 10px;">
                    <div class="form-group">
                        <label>Amount Charged:</label>
                        <input type="text" readonly value="3000" />
                    </div>

                    <div class="form-group">
                        <label>Amount Paid:</label>
                        <input type="text" readonly value="3000" />
                    </div>

                    <div class="form-group">
                        <label>Balance:</label>
                        <input type="text" readonly value="0" />
                    </div>
                </div>

                <!-- Right Side: Doctor's Remarks -->
                <div class="remarks-container">
                    <label for="remarks">Doctor's Remarks:</label>
                    <textarea id="remarks" style="width: 100%; height: 100%;"></textarea>
                </div>


            </div></div>
        </div>
                       <!-- Action Buttons -->
                <div class="button-container">
                    <button class="modal-button warning">Cancel</button>
                    <button class="modal-button secondary-button normal">Mark as Done</button>
                </div>
    </div>