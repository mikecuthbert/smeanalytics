
<main class='main'>

                    <style>
                        iframe {border:none;}
                        .page {background:#EAEAEA;}
                        .main {padding:0px!important;}
                        body {
                                overflow:hidden;
                            }
                    </style>

                    <div id="embedContainer" class="embedContainer" style="height:100%"></div>
</main>


                     <script>
                                $(document).ready(function(){
                                    $('#embedContainer').height($(window).height());
                                });

                                // Read embed application token from Model
                                var embedToken  = '<?= $embedtoken ;?>';
                                // Read report Id from Model
                                var reportId    = '<?= $report_id ;?>';
                                // Read embed URL from Model
                                var embedUrl    = '<?= $embedURL ;?>';
                                // Set report page
//                                var reportPage = 'ReportSection107f934335442ff1176d';
                                var reportPage  = '<?= $page_id ;?>';
                                // Build the filter you want to use. For more information, See Constructing
                                // Filters in https://github.com/Microsoft/PowerBI-JavaScript/wiki/Filters.
//                                const filter = {
//                                  $schema: "http://powerbi.com/product/schema#basic",
//                                  target: {
//                                    table: "company",
//                                    column: "Company"
//                                  },
//                                  operator: "In",
//                                  values: ["Adopt Demo"]
//                                };

                                // Get models. models contains enums that can be used.
                                var models = window['powerbi-client'].models;
                                // We give All permissions to demonstrate switching between View and Edit mode and saving report.
                                var permissions = models.Permissions.All;
                                // Embed configuration used to describe the what and how to embed.
                                // This object is used when calling powerbi.embed.
                                // This also includes settings and options such as filters.
                                // You can find more information at https://github.com/Microsoft/PowerBI-JavaScript/wiki/Embed-Configuration-Details.

                                var config= {
                                    type: 'report',
                                    tokenType: models.TokenType.Embed,
                                    accessToken: embedToken,
                                    embedUrl: embedUrl,
                                    id: reportId,
                                    permissions: permissions,
                                    pageName: reportPage,
                                    settings: {
                                        filterPaneEnabled: true,
                                        navContentPaneEnabled: false
                                    };

                                    // Get a reference to the embedded report HTML element
                                    var embedContainer = $('#embedContainer')[0];
                                    // Embed the report and display it within the div container.
                                    var report = powerbi.embed(embedContainer, config);

                                // Set the filter for the report.
                                // Pay attention that setFilters receives an array.
//                                report.setFilters([filter])
//                                    .catch(function (errors) {
//                                        Log.log(errors);
//                                    });



                    </script>

	</body>

</html>
