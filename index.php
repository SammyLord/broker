<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Broker</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            line-height: 1.6;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="email"],
        input[type="tel"],
        textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        textarea {
            height: 100px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        .error {
            color: red;
            margin-top: 5px;
        }
        .success {
            color: green;
            margin-top: 5px;
        }
    </style>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <h1>Broker</h1>
    <h2>Free Data Deletion Request Form</h2>
    <h3>Version 2.0</h3>
    
    <?php
    // Enable error reporting at the top of the file
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    ini_set('log_errors', 1);
    ini_set('error_log', 'broker_errors.log');

    // Increase memory limit and execution time
    ini_set('memory_limit', '256M');
    set_time_limit(300); // 5 minutes

    // List of data broker email addresses
    $dataBrokerEmails = [
        'CustomerSupport@TLO.com',
        'DataPrivacyOfficer@ldschurch.org',
        'TLOxp@transunion.com',
        'abacusoptout@epsilon.com',
        'admin@411.info',
        'admin@corporationwiki.com',
        'assist@verecor.com',
        'brett.mcwhorter@melissa.com',
        'callyo.support@motorolasolutions.com',
        'clients@quickpeopletrace.com',
        'consumeradvo@acxiom.com',
        'contactus@shoppers-voice.com',
        'criscros@haines.com',
        'customer-service@phoneowner.com',
        'customer-support@rehold.com',
        'customercare@irbsearch.com',
        'customercare@spokeo.com',
        'customerservice@backgroundalert.com',
        'customerservice@delvepoint.com',
        'customersolutions@ancestry.com',
        'custserv@haines.com',
        'data.protection@opencorporates.com',
        'dataoptout1@epsilon.com',
        'donotmaillist@directmail.com',
        'ethics@the-dma.org',
        'hello@peeplookup.com',
        'hello@spytox.com',
        'help@meritpages.com',
        'help@neighbor.report',
        'help@phonebooks.com',
        'info@PeopleWhiz.com',
        'info@buzzfile.com',
        'info@haines.com',
        'info@infospace.com',
        'info@people-search.org',
        'info@peoplefinder.com',
        'info@peoplesearchnow.com',
        'info@radaris.com',
        'info@skulocal.com',
        'info@truecaller.com',
        'info@yasni.com',
        'info@zabasearch.com',
        'ken@sync.me',
        'legal@city-data.com',
        'lookupuk@gmail.com',
        'mail@pipl.com',
        'optout@epsilon.com',
        'others@city-data.com',
        'paul.nelson@melissa.com',
        'paulmfield@gmail.com',
        'press@yp.com',
        'privacy.information.mgr@lexisnexis.com',
        'privacy.issues@thomsonreuters.com',
        'privacy@archives.com',
        'privacy@beenverified.com',
        'privacy@fama.io',
        'privacy@infopay.com',
        'privacy@instantcheckmate.com',
        'privacy@intelius.com',
        'privacy@mylife.com',
        'privacy@peopledatalabs.com',
        'privacy@peoplesmart.com',
        'privacy@plaid.com',
        'privacy@whooster.com',
        'privacy@wyty.com',
        'privacy@zoominfo.com',
        'privacychoices@pchmail.com',
        'privacyteam@data-axle.com',
        'removal@veripages.com',
        'research@usatrace.com',
        'response@zabasearch.com',
        'scarlett@blockshopper.com',
        'support@411.info',
        'support@OkCaller.com',
        'support@addresses.com',
        'support@addresssearch.com',
        'support@ancestry.com',
        'support@apollo.io',
        'support@catalogchoice.org',
        'support@cellrevealer.com',
        'support@checkpeople.com',
        'support@cocofinder.com',
        'support@connectedinvestors.com',
        'support@contactout.com',
        'support@findpeoplesearch.com',
        'support@gladiknow.com',
        'support@golookup.com',
        'support@idcrawl.com',
        'support@idtrue.com',
        'support@infospace.com',
        'support@instantcheckmate.com',
        'support@mailer.intelius.com',
        'support@myheritage.com',
        'support@nationalcellulardirectory.com',
        'support@numberguru.com',
        'support@nuwber.com',
        'support@officialusa.com',
        'support@old-friends.co',
        'support@peekyou.com',
        'support@peoplebyname.com',
        'support@peoplebyphone.com',
        'support@peoplefinder.com',
        'support@peoplefinders.com',
        'support@peoplesearchnow.com',
        'support@peopletraceuk.com',
        'support@persopo.com',
        'support@pipl.com',
        'support@propertyshark.com',
        'support@publicinfoservices.com',
        'support@radaris.com',
        'support@revealname.com',
        'support@revealphoneowner.com',
        'support@salespider.com',
        'support@searchbug.com',
        'support@spokeo.com',
        'support@spydialer.com',
        'support@spyfly.com',
        'support@staterecords.org',
        'support@truecaller.com',
        'support@truepeoplesearch.net',
        'support@truthfinder.com',
        'support@ufind.name',
        'support@usphonebook.com',
        'support@ussearch.com',
        'support@vehiclehistory.com',
        'support@veripages.com',
        'support@whitepages.com',
        'support@yasni.com',
        'support@zoominfo.com',
        'webmaster@allpeople.com',
        'welcome@socialcatfish.com',
        'west.privacypolicy@thomson.com',
        'ypcsupport@yp.com'
    ];    

    $errors = [];
    $success = false;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        try {
            // Validate and sanitize input
            $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
            $addresses = filter_input(INPUT_POST, 'addresses', FILTER_SANITIZE_STRING);
            $emails = filter_input(INPUT_POST, 'emails', FILTER_SANITIZE_STRING);
            $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);

            // Validation
            if (empty($name)) {
                throw new Exception("Name is required");
            }
            if (empty($emails)) {
                throw new Exception("At least one email address is required");
            }
            if (empty($phone)) {
                throw new Exception("Phone number is required");
            }

            // Validate email format
            $emailArray = array_map('trim', explode(',', $emails));
            foreach ($emailArray as $email) {
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    throw new Exception("Invalid email format: " . htmlspecialchars($email));
                }
            }

            // Prepare email content
            $emailContent = "Dear Data Broker,\n\n";
            $emailContent .= "I am submitting a request for implementation of the following rights under Section 1798.105 of CCPA, Articles 7(3), 17 and 21 of GDPR and other applicable privacy legislation which grant individuals certain rights in relation to protection of their personal data information:\n\n";
            $emailContent .= "1) To obtain erasure (deletion) of personal data (information) without undue delay;\n";
            $emailContent .= "2) To withdraw any consent given to the processing of personal data (information);\n";
            $emailContent .= "3) To object to processing of personal data (information) concerning the below individual, including but not limited to profiling, data of related individuals, and direct marketing.\n\n";
            $emailContent .= "I can be identified by my details below:\n\n";
            $emailContent .= "Name: " . $name . "\n";
            $emailContent .= "Addresses possibly in your database: " . $addresses . "\n";
            $emailContent .= "E-mail addresses: " . $emails . "\n";
            $emailContent .= "Phone number: " . $phone . "\n\n";
            $emailContent .= "Please confirm your compliance with the request without undue delay and in any event within 45 (forty five) days of receipt of this request.\n\n";
            
            $emailContent .= "Do not reply to any emails in this list or the email we sent. Just comply and carry on.\n";
            $emailContent .= "Remember: You are bound by law to comply, with no questions asked. We don't really care if you have an online form - just comply with our request without any arguments or replies - including but not limited to emails listed.\n";
            $emailContent .= "And, no, you SHOULDN'T need more data than this to drop this data from your records - no matter what database software you use, even if it's MySQL or Microsoft Access, you should NOT need any more details.\n";

            $emailContent .= "Thank you.\n" . $name . " and the Broker open source data removal solution.";
            
            // Email headers
            $headers = "From: noreply@nodemixaholic.com\r\n";
            $headers .= "Reply-To: " . "noreply@to.anyone.listed.sparksammy.com" . "\r\n"; # nope out reply emails. i'm so goofy for not spotting this.
            $headers .= "X-Mailer: PHP/" . phpversion();
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

            // Track successful/failed sends
            $results = [
                'success' => [],
                'failed' => []
            ];

            // Send emails to all data brokers
            $allSent = true;
            $totalBrokers = count($dataBrokerEmails);
            $currentBroker = 0;

            foreach ($dataBrokerEmails as $brokerEmail) {
                $currentBroker++;
                $subject = "Data Deletion Request - " . $name;
                
                // Log attempt
                error_log("Attempting to send email {$currentBroker}/{$totalBrokers} to: {$brokerEmail}");
                
                try {
                    if (mail($brokerEmail, $subject, $emailContent, $headers)) {
                        $results['success'][] = $brokerEmail;
                        error_log("Successfully sent to: {$brokerEmail}");
                    } else {
                        throw new Exception("Mail function returned false");
                    }
                } catch (Exception $e) {
                    $results['failed'][] = $brokerEmail;
                    $allSent = false;
                    $errorMessage = "Failed to send email to {$brokerEmail}: " . $e->getMessage();
                    error_log($errorMessage);
                    $errors[] = $errorMessage;
                }

                // Add delay between sends
                if ($currentBroker < $totalBrokers) {
                    sleep(0.1);
                }
            }

            if ($allSent) {
                $success = true;
                error_log("All emails sent successfully");
            } else {
                error_log("Some emails failed to send. Success: " . count($results['success']) . ", Failed: " . count($results['failed']));
            }

        } catch (Exception $e) {
            error_log("Error in form processing: " . $e->getMessage());
            $errors[] = "An error occurred: " . $e->getMessage();
        }
    }
    ?>

    <?php if ($success): ?>
        <div class="success">
            <p>Your data deletion request has been sent successfully to all data brokers.</p>
            <?php if (!empty($results['failed'])): ?>
                <p>Note: Some emails failed to send. Failed recipients: <?php echo count($results['failed']); ?> out of <?php echo count($dataBrokerEmails); ?></p>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($errors)): ?>
        <div class="error">
            <?php foreach ($errors as $error): ?>
                <p><?php echo htmlspecialchars($error); ?></p>
            <?php endforeach; ?>
            <?php if (!empty($results['success'])): ?>
                <p>Successfully sent to <?php echo count($results['success']); ?> data brokers.</p>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="" id="deletionForm">
        <!-- Add a hidden progress div -->
        <div id="progress" style="display: none; margin: 20px 0; padding: 10px; background: #f5f5f5; border-radius: 4px;">
            <p>Sending requests... <span id="progressCount">0</span>/<?php echo count($dataBrokerEmails); ?></p>
            <div style="width: 100%; background: #ddd; border-radius: 4px;">
                <div id="progressBar" style="width: 0%; height: 20px; background: #4CAF50; border-radius: 4px; transition: width 0.1s;"></div>
            </div>
        </div>

        <div class="form-group">
            <label for="name">Full Name:</label>
            <input type="text" id="name" name="name" required 
                   value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>">
        </div>

        <div class="form-group">
            <label for="addresses">Addresses (one per line):</label>
            <textarea id="addresses" name="addresses"><?php echo isset($_POST['addresses']) ? htmlspecialchars($_POST['addresses']) : ''; ?></textarea>
        </div>

        <div class="form-group">
            <label for="emails">Email Addresses (comma-separated):</label>
            <input type="text" id="emails" name="emails" required 
                   value="<?php echo isset($_POST['emails']) ? htmlspecialchars($_POST['emails']) : ''; ?>">
        </div>

        <div class="form-group">
            <label for="phone">Phone Number:</label>
            <input type="tel" id="phone" name="phone" required 
                   value="<?php echo isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : ''; ?>">
        </div>

        <button type="submit" id="submitButton">Submit Request</button>
    </form>

    <script>
    document.getElementById('deletionForm').onsubmit = function() {
        var progress = document.getElementById('progress');
        var progressBar = document.getElementById('progressBar');
        var progressCount = document.getElementById('progressCount');
        var submitButton = document.getElementById('submitButton');
        
        // Show progress and disable submit button
        progress.style.display = 'block';
        submitButton.disabled = true;
        submitButton.textContent = 'Sending...';
        
        // Start progress updates
        var total = <?php echo count($dataBrokerEmails); ?>;
        var current = 0;
        
        var progressInterval = setInterval(function() {
            current++;
            var percent = (current / total) * 100;
            progressBar.style.width = percent + '%';
            progressCount.textContent = current;
            
            if (current >= total) {
                clearInterval(progressInterval);
            }
        }, 100); // Update every 100ms
    };
    </script>
</body>
</html>