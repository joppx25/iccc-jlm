<?php
// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Handle export request
if (isset($_POST['export_registrations'])) {
    $export_type = sanitize_text_field($_POST['export_type']);
    $date_from = sanitize_text_field($_POST['date_from']);
    $date_to = sanitize_text_field($_POST['date_to']);
    
    // Build query arguments
    $args = array(
        'post_type' => 'registration',
        'numberposts' => -1,
        'post_status' => 'publish'
    );
    
    // Add date filters if specified
    if ($date_from || $date_to) {
        $args['date_query'] = array();
        
        if ($date_from) {
            $args['date_query']['after'] = $date_from;
        }
        
        if ($date_to) {
            $args['date_query']['before'] = $date_to;
        }
    }
    
    // Add nationality filter if specified
    if ($export_type !== 'all') {
        $args['meta_query'] = array(
            array(
                'key' => 'nationality',
                'value' => $export_type
            )
        );
    }
    
    $registrations = get_posts($args);
    
    // Generate filename
    $filename = 'conference_registrations_' . $export_type . '_' . date('Y-m-d') . '.csv';
    
    // Set headers for download
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    
    $output = fopen('php://output', 'w');
    
    // CSV headers
    fputcsv($output, array(
        'Registration ID',
        'First Name',
        'Last Name',
        'Email',
        'Phone',
        'Nationality',
        'Package',
        'Emergency Contact Name',
        'Emergency Contact Phone',
        'Emergency Relationship',
        'Dietary Requirements',
        'Special Needs',
        'Registration Date'
    ));
    
    // Export data
    foreach ($registrations as $registration) {
        $meta = get_post_meta($registration->ID);
        
        fputcsv($output, array(
            $registration->ID,
            $meta['first_name'][0] ?? '',
            $meta['last_name'][0] ?? '',
            $meta['email'][0] ?? '',
            $meta['phone'][0] ?? '',
            $meta['nationality'][0] ?? '',
            $meta['package'][0] ?? '',
            $meta['emergency_name'][0] ?? '',
            $meta['emergency_phone'][0] ?? '',
            $meta['emergency_relationship'][0] ?? '',
            $meta['dietary_requirements'][0] ?? '',
            $meta['special_needs'][0] ?? '',
            get_the_date('Y-m-d H:i:s', $registration->ID)
        ));
    }
    
    fclose($output);
    exit;
}

// Get statistics for display
$total_registrations = wp_count_posts('registration')->publish;
$philippine_count = count(get_posts(array(
    'post_type' => 'registration',
    'meta_query' => array(array('key' => 'nationality', 'value' => 'philippine')),
    'numberposts' => -1
)));
$international_count = count(get_posts(array(
    'post_type' => 'registration',
    'meta_query' => array(array('key' => 'nationality', 'value' => 'international')),
    'numberposts' => -1
)));
?>

<div class="wrap">
    <h1>Export Registrations</h1>
    
    <div class="export-stats">
        <div class="stat-item">
            <strong><?php echo $total_registrations; ?></strong>
            <span>Total Registrations</span>
        </div>
        <div class="stat-item">
            <strong><?php echo $philippine_count; ?></strong>
            <span>Philippine Delegates</span>
        </div>
        <div class="stat-item">
            <strong><?php echo $international_count; ?></strong>
            <span>International Delegates</span>
        </div>
    </div>
    
    <div class="export-form-container">
        <form method="post" class="export-form">
            <table class="form-table">
                <tbody>
                    <tr>
                        <th scope="row">
                            <label for="export_type">Export Type</label>
                        </th>
                        <td>
                            <select name="export_type" id="export_type" class="regular-text">
                                <option value="all">All Registrations</option>
                                <option value="philippine">Philippine Delegates Only</option>
                                <option value="international">International Delegates Only</option>
                            </select>
                            <p class="description">Choose which registrations to export.</p>
                        </td>
                    </tr>
                    
                    <tr>
                        <th scope="row">
                            <label for="date_from">Date Range</label>
                        </th>
                        <td>
                            <input type="date" name="date_from" id="date_from" class="regular-text">
                            <span>to</span>
                            <input type="date" name="date_to" id="date_to" class="regular-text">
                            <p class="description">Optional: Filter by registration date range.</p>
                        </td>
                    </tr>
                </tbody>
            </table>
            
            <p class="submit">
                <input type="submit" name="export_registrations" class="button-primary" value="Export to CSV">
            </p>
        </form>
    </div>
    
    <div class="export-info">
        <h3>Export Information</h3>
        <p>The CSV export will include the following columns:</p>
        <ul>
            <li>Registration ID</li>
            <li>Personal Information (Name, Email, Phone)</li>
            <li>Nationality and Package Selection</li>
            <li>Emergency Contact Details</li>
            <li>Special Requirements (Dietary, Accessibility)</li>
            <li>Registration Date and Time</li>
        </ul>
        
        <div class="notice notice-info">
            <p><strong>Privacy Notice:</strong> Exported data contains personal information. Handle according to your privacy policy and applicable data protection regulations.</p>
        </div>
    </div>
</div>

<style>
.export-stats {
    display: flex;
    gap: 20px;
    margin: 20px 0;
}

.stat-item {
    background: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    text-align: center;
    border-left: 4px solid #D4AF37;
    min-width: 150px;
}

.stat-item strong {
    display: block;
    font-size: 2rem;
    color: #2C3E50;
    margin-bottom: 5px;
}

.stat-item span {
    color: #666;
    font-size: 0.9rem;
}

.export-form-container {
    background: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    margin: 20px 0;
}

.export-info {
    background: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    margin: 20px 0;
}

.export-info ul {
    margin-left: 20px;
}

.export-info li {
    margin-bottom: 5px;
}
</style>