<?php
include 'includes/header-member.php'; 

?>
<div class="register-container">  
    <h2>Passenger Details</h2>


    <div class="passenger-form">
        <h3>Passenger 1</h3>
        <div class="form-group">
            <label for="first_name_1">First Name:</label>
            <input type="text" id="first_name_1" name="first_name_1" required>
        </div>

        <div class="form-group">
            <label for="last_name_1">Last Name:</label>
            <input type="text" id="last_name_1" name="last_name_1" required>
        </div>

        <div class="form-group">
            <label for="birth_date_1">Birth Date:</label>
            <input type="date" id="birth_date_1" name="birth_date_1" required>
        </div>

        <div class="form-group">
            <label for="gender_1">Gender:</label>
            <select id="gender_1" name="gender_1" required>
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">Other</option>
            </select>
        </div>

        <div class="form-group">
            <label for="email_1">Email:</label>
            <input type="email" id="email_1" name="email_1" required>
        </div>

        <div class="form-group">
            <label for="confirm_email_1">Confirm Email:</label>
            <input type="email" id="confirm_email_1" name="confirm_email_1" required>
        </div>

        <div class="form-group">
            <label for="phone_1">Phone Number:</label>
            <input type="tel" id="phone_1" name="phone_1" required>
        </div>

        <div class="form-group">
            <label for="state_1">State of Residence:</label>
            <input type="text" id="state_1" name="state_1" required>
        </div>
    </div>

    <div id="extra-passengers"></div>


    <div class="form-buttons">
        <button type="button" id="add-passenger" class="submit-button">Add Passenger</button>
        <button type="submit" class="submit-button">Continue</button>
    </div>
</div>

<?php include 'includes/footer.php'; ?>