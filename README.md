# Broker

A PHP-based web application that helps users submit data deletion requests to data brokers under CCPA and GDPR regulations.

## Overview

Broker is a simple web form that allows users to submit data deletion requests to multiple data brokers simultaneously. The application:

- Sends standardized deletion requests to 120+ data brokers
- Follows CCPA (Section 1798.105) and GDPR (Articles 7(3), 17, and 21) requirements
- Provides real-time progress tracking
- Handles email sending with rate limiting
- Includes error handling and logging

## Requirements

- PHP 7.0 or higher
- Web server (Apache/Nginx)
- PHP mail() function enabled
- Write permissions for error logging

## Installation

1. Clone or download this repository to your web server directory
2. Ensure the web server has write permissions for the error log:
   ```bash
   chmod 666 broker_errors.log
   ```
3. Configure your PHP mail settings in php.ini or use a mail server

## Configuration

The application uses several configurable parameters:

- Email delay: Currently set to 0.1 seconds between sends
- From address: Set to noreply@nodemixaholic.com
- Execution time limit: 5 minutes
- Memory limit: 256MB

To modify these settings, edit the following in `index.php`:
```php
ini_set('memory_limit', '256M');
set_time_limit(300); // 5 minutes
sleep(0.1); // Email delay
```

## Usage

1. Access the web form through your browser
2. Fill in the required fields:
   - Full Name
   - Addresses (one per line)
   - Email Addresses (comma-separated)
   - Phone Number
3. Submit the form
4. Monitor the progress bar
5. Review the success/failure status

## Email Template

The application sends a standardized deletion request that includes:

- CCPA and GDPR rights assertion
- Request for data erasure
- Request for consent withdrawal
- Objection to data processing
- User identification details
- 45-day compliance deadline

## Error Handling

- Errors are logged to `broker_errors.log`
- Failed email attempts are tracked and reported
- Form validation errors are displayed to users
- Success/failure counts are shown after submission

## Security Considerations

- Input sanitization for all form fields
- XSS prevention
- Basic rate limiting
- Error logging for debugging

## Technical Tidbits

### Form Processing Flow
1. **Initial Load**
   - PHP initializes with error reporting and resource limits
   - Loads the data broker email list (120+ addresses)
   - Sets up memory limit (256MB) and execution time (5 minutes)

2. **Form Submission**
   - POST request triggers the main processing logic
   - Input validation and sanitization:
     ```php
     $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
     $emails = filter_input(INPUT_POST, 'emails', FILTER_SANITIZE_STRING);
     ```
   - Email format validation using `filter_var()` with `FILTER_VALIDATE_EMAIL`

3. **Email Generation**
   - Constructs standardized email content with:
     - CCPA/GDPR legal text
     - User identification details
     - 45-day compliance deadline
   - Sets email headers:
     ```php
     $headers = "From: noreply@sparksammy.com\r\n";
     $headers .= "Reply-To: " . $emails . "\r\n";
     $headers .= "MIME-Version: 1.0\r\n";
     $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
     ```

4. **Email Sending Process**
   - Iterates through data broker list
   - Implements rate limiting (0.1s delay between sends)
   - Tracks success/failure in `$results` array
   - Logs each attempt to `broker_errors.log`
   - Progress tracking:
     ```php
     $totalBrokers = count($dataBrokerEmails);
     $currentBroker = 0;
     foreach ($dataBrokerEmails as $brokerEmail) {
         $currentBroker++;
         // ... send email ...
         sleep(0.1);
     }
     ```

### Frontend Implementation
1. **Progress Tracking**
   - JavaScript-based progress bar
   - Updates every 100ms
   - Shows current/total emails
   - Disables submit button during sending
   ```javascript
   var progressInterval = setInterval(function() {
       current++;
       var percent = (current / total) * 100;
       progressBar.style.width = percent + '%';
       progressCount.textContent = current;
   }, 100);
   ```

2. **Form Validation**
   - HTML5 required fields
   - PHP server-side validation
   - Real-time client-side feedback
   - Error message display system

3. **Error Handling System**
   - Multi-level error catching:
     - Form validation errors
     - Email sending failures
     - System-level errors
   - Error logging to file
   - User-friendly error messages
   - Success/failure status display

### Performance Optimizations
1. **Resource Management**
   - Memory limit increase for large email lists
   - Extended execution time for batch processing
   - Rate limiting to prevent server overload
   - Efficient email header construction

2. **Email Delivery**
   - Uses PHP's native `mail()` function
   - Implements delay between sends (0.1s)
   - Tracks delivery status
   - Handles failed deliveries gracefully

3. **Data Processing**
   - Efficient array handling for email list
   - Minimal memory footprint
   - Optimized string concatenation
   - Efficient error tracking

### Security Measures
1. **Input Protection**
   - `filter_input()` for sanitization
   - `htmlspecialchars()` for XSS prevention
   - Email format validation
   - Required field validation

2. **Error Handling**
   - Detailed error logging
   - User-friendly error messages
   - No sensitive data exposure
   - Graceful failure handling

3. **Rate Limiting**
   - Delay between email sends
   - Form submission protection
   - Resource usage monitoring
   - Error tracking and reporting

## Contributing

Feel free to submit issues and enhancements!

## License

This project is under the SPL-R5.