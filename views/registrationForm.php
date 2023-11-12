<div class="registrationContainerHolder">
    <div class="registrationContainer">
        <h2>Registration Form</h2>
        <form id="registrationForm" enctype="multipart/form-data">
            <div class="registration_form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required>
                <span id="emailError" class="error-message"></span>
            </div>
            <div class="registration_form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" required>
                <span id="passwordError" class="error-message"></span>
            </div>
            <div class="registration_form-group">
                <label for="password">Confirm Password:</label>
                <input type="password" name="password" id="confirmPassword" required>
                <span id="confirmPasswordError" class="error-message"></span>
            </div>
            <div class="registration_form-group">
                <label for="firstName">Full Name:</label>
                <input type="text" name="firstName" id="firstName" required>
                <span id="firstNameError" class="error-message"></span>
            </div>
            <div class="registration_form-group">
                <label for="images">Upload Profile Image:</label>
                <input type="file" id="profileImage" name="profileImage" accept="image/jpeg, image/png, image/webp, image/gif" required><br>
            </div>

            <div class="registration_form-group">
                <label>Gender:</label>
                <input type="radio" name="gender" value="male" required> Male
                <input type="radio" name="gender" value="female" required> Female
            </div>

            <div class="registration_form-group" style="display: none"><span class="errorMessage"></span></div>
            <input type="submit" value="Register">
        </form>
        <div class="haveAccountBtn"><a class="linkDecoration" href="login.php">Already Have an Account</a></div>
    </div>
</div>
