<?php

function replacePhoneNumberInDirectory($directory) {
    // Open the directory
    if ($handle = opendir($directory)) {
        // Loop through all files in the directory
        while (false !== ($entry = readdir($handle))) {
            $filePath = $directory . '/' . $entry;

            // Skip directories and dot files (., ..)
            if (is_file($filePath)) {
                // Read the file content
                $content = file_get_contents($filePath);

                // Regular expressions for the phone numbers to replace
                  $patterns = [
                    '/\(\s*727\s*\)\s*273-7217/', // (727) 273-7217
                    '/\+\(\s*727\s*\)\s*273-7217/' // +(727) 273-7217
                ];

                // Replacement string
                $replacement = '+1 323 347 5888';

                // Replace the phone numbers in the content
                $newContent = preg_replace($patterns, $replacement, $content);

                // Write the new content back to the file if changes were made
                if ($content !== $newContent) {
                    file_put_contents($filePath, $newContent);
                    echo "Updated phone number in file: $filePath\n";
                }
            }
        }

        // Close the directory
        closedir($handle);
    } else {
        echo "Failed to open directory: $directory\n";
    }
}

// Specify the directory to scan
$directory = 'includes';

// Call the function to replace phone numbers in the directory
// replacePhoneNumberInDirectory($directory);

function addPlusSignToPhoneNumberInDirectory($directory) {
    // Open the directory
    if ($handle = opendir($directory)) {
        // Loop through all files in the directory
        while (false !== ($entry = readdir($handle))) {
            $filePath = $directory . '/' . $entry;

            // Skip directories and dot files (., ..)
            if (is_file($filePath)) {
                // Read the file content
                $content = file_get_contents($filePath);

                // Regular expression to match the phone number without a plus sign
                $pattern = '/(?<!\+)\b1\s*323\s*347\s*5888\b/';

                // Replacement string
                $replacement = '+1 323 347 5888';

                // Replace the phone numbers in the content
                $newContent = preg_replace($pattern, $replacement, $content);

                // Write the new content back to the file if changes were made
                if ($content !== $newContent) {
                    file_put_contents($filePath, $newContent);
                    echo "Added plus sign to phone number in file: $filePath\n";
                }
            }
        }

        // Close the directory
        closedir($handle);
    } else {
        echo "Failed to open directory: $directory\n";
    }
}

// Specify the directory to scan
// $directory = 'mydir';

// Call the function to add plus sign to phone numbers in the directory
// addPlusSignToPhoneNumberInDirectory($directory);

