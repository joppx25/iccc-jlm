<?php get_header(); ?>

<main class="main-content">
    <section class="registration-section">
        <div class="container">
            <div class="registration-header">
                <h1>Conference Registration</h1>
                <p>Join us for the 1st International Conference of Christian Churches in Galilee, Israel</p>
            </div>

            <div class="registration-content">
                <div class="registration-form-container">
                    <form id="conference-registration" class="registration-form" method="post" action="">
                        <?php wp_nonce_field('conference_registration', 'registration_nonce'); ?>
                        
                        <div class="form-section">
                            <h3>Personal Information</h3>
                            
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="first_name">First Name *</label>
                                    <input type="text" id="first_name" name="first_name" required>
                                </div>
                                
                                <div class="form-group">
                                    <label for="last_name">Last Name *</label>
                                    <input type="text" id="last_name" name="last_name" required>
                                </div>
                            </div>
                            
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="email">Email Address *</label>
                                    <input type="email" id="email" name="email" required>
                                </div>
                                
                                <div class="form-group">
                                    <label for="phone">Phone Number *</label>
                                    <input type="tel" id="phone" name="phone" required>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="nationality">Nationality *</label>
                                <select id="nationality" name="nationality" required>
                                    <option value="">Select your nationality</option>
                                    <option value="philippine">Philippines</option>
                                    <option value="international">International</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-section">
                            <h3>Package Selection</h3>
                            
                            <div class="package-options">
                                <div class="package-option">
                                    <input type="radio" id="package_philippine" name="package" value="philippine">
                                    <label for="package_philippine" class="package-label">
                                        <div class="package-info">
                                            <h4>Philippine Delegates Package</h4>
                                            <div class="package-price">₱195,000</div>
                                            <p>Includes airfare, accommodation, meals, and conference activities</p>
                                        </div>
                                    </label>
                                </div>
                                
                                <div class="package-option">
                                    <input type="radio" id="package_international" name="package" value="international">
                                    <label for="package_international" class="package-label">
                                        <div class="package-info">
                                            <h4>International Delegates Package</h4>
                                            <div class="package-price">$2,270</div>
                                            <p>Includes accommodation, meals, and conference activities</p>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-section">
                            <h3>Emergency Contact</h3>
                            
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="emergency_name">Emergency Contact Name *</label>
                                    <input type="text" id="emergency_name" name="emergency_name" required>
                                </div>
                                
                                <div class="form-group">
                                    <label for="emergency_phone">Emergency Contact Phone *</label>
                                    <input type="tel" id="emergency_phone" name="emergency_phone" required>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="emergency_relationship">Relationship *</label>
                                <input type="text" id="emergency_relationship" name="emergency_relationship" placeholder="e.g., Spouse, Parent, Sibling" required>
                            </div>
                        </div>

                        <div class="form-section">
                            <h3>Additional Information</h3>
                            
                            <div class="form-group">
                                <label for="dietary_requirements">Dietary Requirements</label>
                                <textarea id="dietary_requirements" name="dietary_requirements" rows="3" placeholder="Please specify any dietary restrictions or allergies"></textarea>
                            </div>
                            
                            <div class="form-group">
                                <label for="special_needs">Special Accommodation Needs</label>
                                <textarea id="special_needs" name="special_needs" rows="3" placeholder="Please specify any special accommodation requirements"></textarea>
                            </div>
                        </div>

                        <div class="form-section">
                            <div class="checkbox-group">
                                <input type="checkbox" id="terms_conditions" name="terms_conditions" required>
                                <label for="terms_conditions">
                                    I agree to the <a href="#" class="terms-link">terms and conditions</a> and understand the payment terms and cancellation policy. *
                                </label>
                            </div>
                            
                            <div class="checkbox-group">
                                <input type="checkbox" id="newsletter" name="newsletter">
                                <label for="newsletter">
                                    I would like to receive updates about future conferences and events.
                                </label>
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Submit Registration</button>
                            <p class="payment-note">
                                After registration, you will receive payment instructions via email.
                            </p>
                        </div>
                    </form>
                </div>

                <div class="registration-sidebar">
                    <div class="sidebar-card">
                        <h3>Payment Information</h3>
                        <div class="payment-details">
                            <h4>Philippine Delegates:</h4>
                            <ul>
                                <li>Booking deposit: US$1,400 (₱78,400)</li>
                                <li>Due: September 30, 2025</li>
                                <li>Full payment: US$2,083 (₱116,648)</li>
                                <li>Due: November 15, 2025</li>
                            </ul>
                            
                            <h4>International Delegates:</h4>
                            <ul>
                                <li>Full payment: US$2,270</li>
                                <li>Due: Upon registration</li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="sidebar-card">
                        <h3>Contact Support</h3>
                        <div class="contact-info">
                            <p><strong>General Inquiries:</strong><br>iccc.jlm@gmail.com</p>
                            <p><strong>Travel Coordination:</strong><br>NEW WORLD TRAVEL<br>+63 917 774 0505</p>
                            <p><strong>Registration Support:</strong><br>demarques44@gmail.com</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php
// Handle form submission
if ($_POST && wp_verify_nonce($_POST['registration_nonce'], 'conference_registration')) {
    // Process registration
    $registration_data = array(
        'post_title' => sanitize_text_field($_POST['first_name']) . ' ' . sanitize_text_field($_POST['last_name']),
        'post_content' => '',
        'post_status' => 'publish',
        'post_type' => 'registration'
    );
    
    $registration_id = wp_insert_post($registration_data);
    
    if ($registration_id) {
        // Save meta data
        update_post_meta($registration_id, 'first_name', sanitize_text_field($_POST['first_name']));
        update_post_meta($registration_id, 'last_name', sanitize_text_field($_POST['last_name']));
        update_post_meta($registration_id, 'email', sanitize_email($_POST['email']));
        update_post_meta($registration_id, 'phone', sanitize_text_field($_POST['phone']));
        update_post_meta($registration_id, 'nationality', sanitize_text_field($_POST['nationality']));
        update_post_meta($registration_id, 'package', sanitize_text_field($_POST['package']));
        update_post_meta($registration_id, 'emergency_name', sanitize_text_field($_POST['emergency_name']));
        update_post_meta($registration_id, 'emergency_phone', sanitize_text_field($_POST['emergency_phone']));
        update_post_meta($registration_id, 'emergency_relationship', sanitize_text_field($_POST['emergency_relationship']));
        update_post_meta($registration_id, 'dietary_requirements', sanitize_textarea_field($_POST['dietary_requirements']));
        update_post_meta($registration_id, 'special_needs', sanitize_textarea_field($_POST['special_needs']));
        update_post_meta($registration_id, 'registration_date', current_time('mysql'));
        
        // Send confirmation email
        $to = sanitize_email($_POST['email']);
        $subject = 'Conference Registration Confirmation';
        $message = "Dear " . sanitize_text_field($_POST['first_name']) . ",\n\n";
        $message .= "Thank you for registering for the 1st International Conference of Christian Churches.\n\n";
        $message .= "Registration Details:\n";
        $message .= "Name: " . sanitize_text_field($_POST['first_name']) . ' ' . sanitize_text_field($_POST['last_name']) . "\n";
        $message .= "Package: " . ucfirst(sanitize_text_field($_POST['package'])) . " Delegates Package\n";
        $message .= "Registration ID: " . $registration_id . "\n\n";
        $message .= "Payment instructions will be sent separately.\n\n";
        $message .= "Best regards,\nConference Organizing Committee";
        
        wp_mail($to, $subject, $message);
        
        echo '<div class="registration-success">Registration successful! Check your email for confirmation.</div>';
    }
}
?>

<style>
/* Registration Form Styles */
.registration-section {
    padding: 3rem 0;
    background: var(--light-gray);
}

.registration-header {
    text-align: center;
    margin-bottom: 3rem;
}

.registration-header h1 {
    color: var(--dark-blue);
    font-size: 3rem;
    margin-bottom: 1rem;
}

.registration-content {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 3rem;
    max-width: 1200px;
    margin: 0 auto;
}

.registration-form {
    background: white;
    padding: 2rem;
    border-radius: 10px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}

.form-section {
    margin-bottom: 2.5rem;
    padding-bottom: 2rem;
    border-bottom: 1px solid var(--light-gray);
}

.form-section:last-child {
    border-bottom: none;
}

.form-section h3 {
    color: var(--dark-blue);
    margin-bottom: 1.5rem;
    font-size: 1.5rem;
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
    margin-bottom: 1rem;
}

.form-group {
    margin-bottom: 1rem;
}

.form-group label {
    display: block;
    margin-bottom: 0.5rem;
    font-weight: bold;
    color: var(--dark-blue);
}

.form-group input,
.form-group select,
.form-group textarea {
    width: 100%;
    padding: 0.75rem;
    border: 2px solid #ddd;
    border-radius: 5px;
    font-size: 1rem;
    transition: border-color 0.3s ease;
}

.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus {
    outline: none;
    border-color: var(--primary-gold);
}

.package-options {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
}

.package-option {
    position: relative;
}

.package-option input[type="radio"] {
    position: absolute;
    opacity: 0;
    width: 100%;
    height: 100%;
    cursor: pointer;
}

.package-label {
    display: block;
    padding: 1.5rem;
    background: white;
    border: 3px solid #ddd;
    border-radius: 10px;
    cursor: pointer;
    transition: all 0.3s ease;
    text-align: center;
}

.package-option input[type="radio"]:checked + .package-label {
    border-color: var(--primary-gold);
    background: var(--secondary-gold);
}

.package-info h4 {
    color: var(--dark-blue);
    margin-bottom: 0.5rem;
}

.package-price {
    font-size: 2rem;
    font-weight: bold;
    color: #fff;
    margin: 0.5rem 0;
}

.checkbox-group {
    display: flex;
    align-items: flex-start;
    gap: 0.5rem;
    margin-bottom: 1rem;
}

.checkbox-group input[type="checkbox"] {
    width: auto;
    margin-top: 0.25rem;
}

.checkbox-group label {
    font-weight: normal;
    margin-bottom: 0;
}

.terms-link {
    color: var(--primary-gold);
    text-decoration: none;
}

.terms-link:hover {
    text-decoration: underline;
}

.form-actions {
    text-align: center;
    /* padding-top: 2rem; */
}

.payment-note {
    margin-top: 1rem;
    font-style: italic;
    color: var(--dark-gray);
}

.registration-sidebar {
    display: flex;
    flex-direction: column;
    gap: 2rem;
}

.sidebar-card {
    background: white;
    padding: 2rem;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    border-left: 5px solid var(--primary-gold);
}

.sidebar-card h3 {
    color: var(--dark-blue);
    margin-bottom: 1.5rem;
}

.payment-details h4 {
    color: var(--dark-blue);
    margin: 1rem 0 0.5rem 0;
    font-size: 1.1rem;
}

.payment-details ul {
    list-style: none;
    padding: 0;
    margin-bottom: 1.5rem;
}

.payment-details li {
    padding: 0.25rem 0;
    color: var(--dark-gray);
}

.contact-info p {
    margin-bottom: 1rem;
    line-height: 1.5;
}

.registration-success {
    background: #d4edda;
    color: #155724;
    padding: 1rem;
    border-radius: 5px;
    border: 1px solid #c3e6cb;
    margin-bottom: 2rem;
    text-align: center;
}

@media (max-width: 768px) {
    .registration-content {
        grid-template-columns: 1fr;
        gap: 2rem;
    }
    
    .form-row {
        grid-template-columns: 1fr;
    }
    
    .package-options {
        grid-template-columns: 1fr;
    }
}
</style>

<?php get_footer(); ?>