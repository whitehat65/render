<!DOCTYPE html>
<html>
<head>
    <title>QR Scanner</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f2f2f2;
            margin: 0;
        }
        
        #scanner-container {
            position: relative;
            width: 300px;
            height: 300px;
            overflow: hidden;
            border: 2px solid #007BFF;
        }
        
        #preview {
            width: 100%;
            height: 100%;
        }
    </style>
</head>
<body>
    <div id="scanner-container">
        <video id="preview"></video>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <script>
        const scanner = new Instascan.Scanner({ video: document.getElementById('preview') });

        scanner.addListener('scan', function (content) {
            // Send the scanned content (bandobast_id) to the CodeIgniter controller using AJAX
            $.ajax({
                type: 'POST',
                // url: '<?php echo base_url(); ?>index.php/User/joinBandobast',
                url:'http://localhost.mahapolice.in/index.php/User/joinBandobast',
                data: { bandobast_id: content },
                success: function(response) {
                    // Handle the response from the controller if needed
                    console.log(response);
                },
                error: function(error) {
                    console.error(error);
                }
            });
        });

        Instascan.Camera.getCameras().then(function (cameras) {
            if (cameras.length > 0) {
                scanner.start(cameras[0]);
            } else {
                console.error('No cameras found.');
            }
        }).catch(function (error) {
            console.error(error);
        });
    </script>
</body>
</html>
