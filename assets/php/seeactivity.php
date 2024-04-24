<?php
                    // cloudflare ip (not proxied)
                    $ip = $_SERVER["HTTP_CF_CONNECTING_IP"];



                    



                    $token = "";

                    $geolocation_request = file_get_contents("ip info api");
                    $geolocation_data = json_decode($geolocation_request, true);

       
                    // Browser

                    $user_agent = $_SERVER['HTTP_USER_AGENT'];

                    

                    // Use a simple function to extract browser information

                    function get_browser_info($user_agent) {
                        $browser_info = array("browser" => "Unknown", "version" => "Unknown", "platform" => "Unknown");

                    

                        // Check for common browsers

                        if (preg_match('/MSIE/i', $user_agent) && !preg_match('/Opera/i', $user_agent)) {
                            $browser_info['browser'] = 'Internet Explorer';

                        } elseif (preg_match('/Firefox/i', $user_agent)) {
                            $browser_info['browser'] = 'Mozilla Firefox';

                        } elseif (preg_match('/Chrome/i', $user_agent)) {
                            $browser_info['browser'] = 'Google Chrome';

                        } elseif (preg_match('/Safari/i', $user_agent)) {
                            $browser_info['browser'] = 'Safari';

                        } elseif (preg_match('/Opera/i', $user_agent)) {
                            $browser_info['browser'] = 'Opera';

                        } elseif (preg_match('/Edge/i', $user_agent)) {
                            $browser_info['browser'] = 'Microsoft Edge';

                        }

                    



                        // Get the operating system platform

                        if (preg_match('/Windows/i', $user_agent)) {
                            $browser_info['platform'] = 'Windows';

                        } elseif (preg_match('/Mac/i', $user_agent)) {
                            $browser_info['platform'] = 'Macintosh';

                        } elseif (preg_match('/Linux/i', $user_agent)) {
                            $browser_info['platform'] = 'Linux';

                        } elseif (preg_match('/iPhone|iPad|iPod/i', $user_agent)) {
                            $browser_info['platform'] = 'iOS';

                        } elseif (preg_match('/Android/i', $user_agent)) {
                            $browser_info['platform'] = 'Android';

                        }
                        return $browser_info;
                    }
                    // Get and display browser information

                    $browser_info = get_browser_info($user_agent);
                    ?>