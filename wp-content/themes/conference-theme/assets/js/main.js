document.addEventListener('DOMContentLoaded', function() {
    // Mobile menu toggle
    const mobileToggle = document.querySelector('.mobile-menu-toggle');
    const navMenu = document.querySelector('.nav-menu');
    
    if (mobileToggle && navMenu) {
        mobileToggle.addEventListener('click', function() {
            navMenu.classList.toggle('mobile-active');
        });
    }
    
    // FAQ accordion functionality
    const faqItems = document.querySelectorAll('.faq-item');
    
    faqItems.forEach(item => {
        const question = item.querySelector('.faq-question');
        
        if (question) {
            question.addEventListener('click', () => {
                const isActive = item.classList.contains('active');
                
                // Close all other FAQ items
                faqItems.forEach(otherItem => {
                    otherItem.classList.remove('active');
                });
                
                // Toggle current item
                if (!isActive) {
                    item.classList.add('active');
                }
            });
        }
    });
    
    // Registration form enhancements
    const registrationForm = document.getElementById('conference-registration');
    
    if (registrationForm) {
        // Package selection based on nationality
        const nationalitySelect = document.getElementById('nationality');
        const packageOptions = document.querySelectorAll('input[name="package"]');
        
        if (nationalitySelect && packageOptions.length > 0) {
            nationalitySelect.addEventListener('change', function() {
                const selectedNationality = this.value;
                
                packageOptions.forEach(option => {
                    const packageType = option.value;
                    
                    if (selectedNationality === 'philippine' && packageType === 'international') {
                        option.closest('.package-option').style.opacity = '0.5';
                        option.disabled = true;
                    } else if (selectedNationality === 'international' && packageType === 'philippine') {
                        option.closest('.package-option').style.opacity = '0.5';
                        option.disabled = true;
                    } else {
                        option.closest('.package-option').style.opacity = '1';
                        option.disabled = false;
                    }
                });
            });
        }
        
        // Form validation
        registrationForm.addEventListener('submit', function(e) {
            const requiredFields = this.querySelectorAll('[required]');
            let isValid = true;
            
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    field.style.borderColor = '#e74c3c';
                    isValid = false;
                } else {
                    field.style.borderColor = '#ddd';
                }
            });
            
            // Check if package is selected
            const packageSelected = this.querySelector('input[name="package"]:checked');
            if (!packageSelected) {
                alert('Please select a registration package.');
                isValid = false;
            }
            
            // Check terms and conditions
            const termsChecked = this.querySelector('#terms_conditions:checked');
            if (!termsChecked) {
                alert('Please agree to the terms and conditions.');
                isValid = false;
            }
            
            if (!isValid) {
                e.preventDefault();
                alert('Please fill in all required fields.');
            }
        });
    }
    
    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
    
    // Add loading states to buttons
    document.querySelectorAll('.btn').forEach(button => {
        button.addEventListener('click', function() {
            if (this.type === 'submit') {
                this.textContent = 'Processing...';
                this.disabled = true;
                
                // Re-enable after 3 seconds (in case of form errors)
                setTimeout(() => {
                    this.disabled = false;
                    this.textContent = 'Submit Registration';
                }, 3000);
            }
        });
    });
    
});