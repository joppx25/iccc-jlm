<?php
// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Get registration statistics
$total_registrations = wp_count_posts('registration')->publish;
$philippine_registrations = count(get_posts(array(
    'post_type' => 'registration',
    'meta_query' => array(
        array(
            'key' => 'nationality',
            'value' => 'philippine'
        )
    ),
    'numberposts' => -1
)));
$international_registrations = count(get_posts(array(
    'post_type' => 'registration',
    'meta_query' => array(
        array(
            'key' => 'nationality',
            'value' => 'international'
        )
    ),
    'numberposts' => -1
)));

// Get recent registrations
$recent_registrations = get_posts(array(
    'post_type' => 'registration',
    'numberposts' => 10,
    'orderby' => 'date',
    'order' => 'DESC'
));
?>

<div class="wrap conference-dashboard">
    <h1 class="wp-heading-inline">Conference Dashboard</h1>
    
    <div class="dashboard-stats">
        <div class="stat-card">
            <div class="stat-number"><?php echo $total_registrations; ?></div>
            <div class="stat-label">Total Registrations</div>
        </div>
        
        <div class="stat-card">
            <div class="stat-number"><?php echo $philippine_registrations; ?></div>
            <div class="stat-label">Philippine Delegates</div>
        </div>
        
        <div class="stat-card">
            <div class="stat-number"><?php echo $international_registrations; ?></div>
            <div class="stat-label">International Delegates</div>
        </div>
        
        <div class="stat-card">
            <div class="stat-number">
                <?php 
                $revenue = ($philippine_registrations * 195000) + ($international_registrations * 2270);
                echo number_format($revenue);
                ?>
            </div>
            <div class="stat-label">Estimated Revenue (₱)</div>
        </div>
    </div>

    <div class="dashboard-content">
        <div class="dashboard-main">
            <div class="card">
                <div class="card-header">
                    <h2>Recent Registrations</h2>
                    <a href="<?php echo admin_url('edit.php?post_type=registration'); ?>" class="button">View All</a>
                </div>
                
                <div class="registrations-table">
                    <?php if ($recent_registrations): ?>
                        <table class="wp-list-table widefat fixed striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Nationality</th>
                                    <th>Package</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($recent_registrations as $registration): 
                                    $meta = get_post_meta($registration->ID);
                                    $first_name = $meta['first_name'][0] ?? '';
                                    $last_name = $meta['last_name'][0] ?? '';
                                    $email = $meta['email'][0] ?? '';
                                    $nationality = $meta['nationality'][0] ?? '';
                                    $package = $meta['package'][0] ?? '';
                                ?>
                                    <tr>
                                        <td><?php echo esc_html($first_name . ' ' . $last_name); ?></td>
                                        <td><?php echo esc_html($email); ?></td>
                                        <td>
                                            <span class="nationality-badge <?php echo $nationality; ?>">
                                                <?php echo ucfirst($nationality); ?>
                                            </span>
                                        </td>
                                        <td><?php echo ucfirst($package); ?></td>
                                        <td><?php echo get_the_date('M j, Y', $registration->ID); ?></td>
                                        <td>
                                            <a href="<?php echo get_edit_post_link($registration->ID); ?>" class="button button-small">View</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <p>No registrations yet.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        
        <div class="dashboard-sidebar">
            <div class="card">
                <div class="card-header">
                    <h3>Quick Actions</h3>
                </div>
                <div class="quick-actions">
                    <a href="<?php echo admin_url('admin.php?page=export-registrations'); ?>" class="action-button export">
                        <span class="dashicons dashicons-download"></span>
                        Export Registrations
                    </a>
                    
                    <a href="<?php echo home_url('/registration'); ?>" class="action-button view" target="_blank">
                        <span class="dashicons dashicons-external"></span>
                        View Registration Page
                    </a>
                    
                    <a href="<?php echo admin_url('edit.php?post_type=registration'); ?>" class="action-button manage">
                        <span class="dashicons dashicons-list-view"></span>
                        Manage All Registrations
                    </a>
                </div>
            </div>
            
            <div class="card">
                <div class="card-header">
                    <h3>Conference Information</h3>
                </div>
                <div class="conference-info">
                    <p><strong>Date:</strong> December 7-17, 2025</p>
                    <p><strong>Location:</strong> Galilee, Israel</p>
                    <p><strong>Duration:</strong> 11 days (including travel)</p>
                    <p><strong>Conference Days:</strong> 2 days</p>
                    
                    <div class="package-limits">
                        <h4>Package Limits</h4>
                        <p>Philippine Delegates: 150 PAX</p>
                        <p>International Delegates: 150 PAX</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.conference-dashboard {
    margin: 20px 0;
}

.dashboard-stats {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    margin-bottom: 30px;
}

.stat-card {
    background: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    text-align: center;
    border-left: 4px solid #D4AF37;
}

.stat-number {
    font-size: 2.5rem;
    font-weight: bold;
    color: #2C3E50;
    margin-bottom: 5px;
}

.stat-label {
    color: #666;
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.dashboard-content {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 30px;
}

.card {
    background: white;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    overflow: hidden;
}

.card-header {
    padding: 20px;
    background: #f8f9fa;
    border-bottom: 1px solid #dee2e6;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.card-header h2,
.card-header h3 {
    margin: 0;
    color: #2C3E50;
}

.registrations-table {
    padding: 20px;
}

.nationality-badge {
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 0.8rem;
    font-weight: bold;
    text-transform: uppercase;
}

.nationality-badge.philippine {
    background: #e3f2fd;
    color: #1976d2;
}

.nationality-badge.international {
    background: #f3e5f5;
    color: #7b1fa2;
}

.quick-actions {
    padding: 20px;
}

.action-button {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 12px;
    margin-bottom: 10px;
    background: #f8f9fa;
    border: 1px solid #dee2e6;
    border-radius: 6px;
    text-decoration: none;
    color: #495057;
    transition: all 0.3s ease;
}

.action-button:hover {
    background: #D4AF37;
    color: white;
    text-decoration: none;
}

.action-button.export:hover { background: #28a745; }
.action-button.view:hover { background: #007bff; }
.action-button.manage:hover { background: #6c757d; }

.conference-info {
    padding: 20px;
}

.conference-info p {
    margin-bottom: 10px;
    color: #495057;
}

.package-limits {
    margin-top: 20px;
    padding-top: 20px;
    border-top: 1px solid #dee2e6;
}

.package-limits h4 {
    color: #2C3E50;
    margin-bottom: 10px;
}

@media (max-width: 768px) {
    .dashboard-content {
        grid-template-columns: 1fr;
    }
    
    .dashboard-stats {
        grid-template-columns: repeat(2, 1fr);
    }
}
</style>