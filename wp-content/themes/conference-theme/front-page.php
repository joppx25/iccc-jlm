<?php get_header(); ?>

<main class="main-content">
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-background">
            <div class="hero-overlay">
                <div class="container">
                    <div class="hero-content">
                        <h1>1st International Conference of Christian Churches</h1>
                        <h2>Galilee, Israel</h2>
                        <p class="hero-subtitle">Two-day Conference and Site Activities</p>
                        <p class="hero-date">December 7-17, 2025 (including travel days)</p>
                        
                        <blockquote class="bible-verse">
                            "My prayer is that all of them may be one, Father, just as You are in Me and I am in You. May they also be in Us." 
                            <cite>- John 17:20-21</cite>
                        </blockquote>
                        
                        <div class="hero-actions">
                            <a href="<?php echo home_url('/registration'); ?>" class="btn btn-primary">Register Now</a>
                            <a href="<?php echo home_url('/faq'); ?>" class="btn btn-secondary">Learn More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Circular Images Section -->
    <!-- <section class="activities-preview">
        <div class="container">
            <div class="circular-images">
                <div class="circular-image">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/galilee-boat.jpg" alt="Galilee Boat">
                </div>
                <div class="circular-image">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/ancient-building.jpg" alt="Ancient Building">
                </div>
                <div class="circular-image">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/church-tower.jpg" alt="Church Tower">
                </div>
            </div>
        </div>
    </section> -->

    <!-- Package Information -->
    <section class="packages-section">
        <div class="container">
            <h2>Conference Packages</h2>
            
            <div class="packages-grid">
                <!-- Philippine Delegates -->
                <div class="package-card">
                    <h3>For Philippine Delegates</h3>
                    <div class="package-price">
                        <span class="currency">PHP</span>
                        <span class="amount">₱195,000</span>
                        <span class="per">per person</span>
                    </div>
                    
                    <div class="package-details">
                        <h4>Inclusions:</h4>
                        <ul>
                            <li>International round trip airfare on economy</li>
                            <li>8-night hotel accommodation with meals on twin-sharing</li>
                            <li>Airport assistance upon arrival</li>
                            <li>2-day conference activities</li>
                        </ul>
                        
                        <h4>Exclusions:</h4>
                        <ul>
                            <li>Domestic Fares</li>
                            <li>ETA-IL entry permit fee (US$7)</li>
                            <li>Personal expenses</li>
                            <li>All others not mentioned in itinerary</li>
                        </ul>
                    </div>
                    
                    <a href="<?php echo home_url('/registration'); ?>?package=philippine" class="btn">Register as Philippine Delegate</a>
                </div>

                <!-- International Delegates -->
                <div class="package-card">
                    <h3>For Foreign Delegates</h3>
                    <div class="package-price">
                        <span class="currency">USD</span>
                        <span class="amount">$2,270</span>
                        <span class="per">per person</span>
                    </div>
                    
                    <div class="package-details">
                        <h4>Inclusions:</h4>
                        <ul>
                            <li>3-night accommodation with meals on twin-sharing</li>
                            <li>Airport assistance upon arrival</li>
                            <li>2-day conference and post conference activities</li>
                        </ul>
                        
                        <h4>Exclusions:</h4>
                        <ul>
                            <li>International Air Fare</li>
                            <li>International travel insurance</li>
                            <li>ETA-IL entry permit fee (US$7)</li>
                            <li>Personal expenses</li>
                        </ul>
                    </div>
                    
                    <a href="<?php echo home_url('/registration'); ?>?package=international" class="btn">Register as International Delegate</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Activities Section -->
    <section class="activities-section">
        <div class="container">
            <h2>Post-Conference Activities</h2>
            <div class="activities-grid">
                <div class="activity-item">
                    <h4>Historical Sites</h4>
                    <ul>
                        <li>Caesarea</li>
                        <li>Tel Megiddo</li>
                        <li>Muchraka / Mt. Carmel</li>
                        <li>Nazareth 1st Century Village</li>
                    </ul>
                </div>
                
                <div class="activity-item">
                    <h4>Religious Sites</h4>
                    <ul>
                        <li>Church of Cana</li>
                        <li>Nativity Church</li>
                        <li>Garden of Gethsamane</li>
                        <li>Shepherds' Fields</li>
                    </ul>
                </div>
                
                <div class="activity-item">
                    <h4>Cultural Experiences</h4>
                    <ul>
                        <li>Boat Ride Galilee Sailing</li>
                        <li>City of David</li>
                        <li>Garden Tomb</li>
                        <li>Kalia Beach Dead Sea</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <h2>Ready to Join Us?</h2>
            <p>Experience the unity of Christian churches from around the world in the Holy Land.</p>
            <div class="cta-actions">
                <a href="<?php echo home_url('/registration'); ?>" class="btn btn-primary">Register Now</a>
                <a href="<?php echo home_url('/faq'); ?>" class="btn btn-secondary">Have Questions?</a>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>