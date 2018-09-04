
<?php

if(isset($_GET['P'])) {$page_id = $_GET['P'];} else {$page_id ='ReportSection';}

/// SET THE PAGE ID IN A SESSION VARIABLE (MAYBE AVOID SETTING COOKIES AT ALL EXCEPT THE USERS ACTIVE SESSION??)
$_SESSION["page"] = $page_id;

/* Get oauth2 token using a POST request */
$curlPostToken = curl_init();

curl_setopt_array($curlPostToken, array(
                                    CURLOPT_URL             => $api_url,
                                    CURLOPT_SSL_VERIFYPEER  => false,
                                    CURLOPT_RETURNTRANSFER  => true,
                                    CURLOPT_ENCODING        => "",
                                    CURLOPT_MAXREDIRS       => 10,
                                    CURLOPT_TIMEOUT         => 30,
                                    CURLOPT_HTTP_VERSION    => CURL_HTTP_VERSION_1_1,
                                    CURLOPT_HTTPHEADER      => array("application/x-www-form-urlencoded"),
                                    CURLOPT_CUSTOMREQUEST   => "POST",
                                    CURLOPT_POSTFIELDS      => array(
                                                'client_id'      => $api_client_id, // Registered App ApplicationID
                                                'client_secret'  => $api_client_secret,
                                                'scope'          => 'openid',
                                                'grant_type'     => 'password',
                                                'resource'       => $api_resource,
                                                'username'       => $api_username,  // for example john.doe@yourdomain.com
                                                'password'       => $api_password   // Azure password for above user
                                                )
                                        ));

$accesstokenResponse    = curl_exec($curlPostToken);
$accesstokenError       = curl_error($curlPostToken);
curl_close($curlPostToken);

// decode result, and store the access_token in $embeddedToken variable:
$accesstokenResult      = json_decode($accesstokenResponse, true);
$accesstoken            = $accesstokenResult["access_token"];
$embeddedToken          = "Bearer "  . ' ' .  $accesstoken;

$curlEmbedToken = curl_init();

            // report version
            $embedURL               = 'https://app.powerbi.com/reportEmbed?reportId=' . $report_id . '&groupId=' . $group_id;
            curl_setopt_array($curlEmbedToken, array(
                                                CURLOPT_URL             => "https://api.powerbi.com/v1.0/myorg/groups/$group_id/reports/$report_id/GenerateToken",
                                                CURLOPT_SSL_VERIFYPEER  => false,
                                                CURLOPT_RETURNTRANSFER  => true,
                                                CURLOPT_ENCODING        => "",
                                                CURLOPT_MAXREDIRS       => 10,
                                                CURLOPT_TIMEOUT         => 30,
                                                CURLOPT_HTTP_VERSION    => CURL_HTTP_VERSION_1_1,
                                                CURLOPT_CUSTOMREQUEST   => "POST",
                                                CURLOPT_POSTFIELDS      => "accessLevel: View",
                                                CURLOPT_HTTPHEADER      => array(
                                                                            "Authorization: $embeddedToken",
                                                                            "Cache-Control: no-cache",
                                                                            "Content-Type: application/x-www-form-urlencoded",
                                                                            )
                                                    )
                              );

            $embedResponse = curl_exec($curlEmbedToken);
            $embedError = curl_error($curlEmbedToken);
            curl_close($curlEmbedToken);

            $embedtokenResult            = json_decode($embedResponse, true);
            $embedtoken                  = $embedtokenResult["token"];

            if ($embedError) {
                                echo "cURL Error #:" . $embedError;
                          }

?>
