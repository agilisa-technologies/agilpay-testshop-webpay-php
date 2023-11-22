<!DOCTYPE html>
<html>
<head>
    <title>Send POST Request</title>
</head>
<body>
    <h2>Click the button to send your Order</h2>
    <form id="postDataForm">
        <button type="button" onclick="getTokenAndSubmit()">Pay your order</button>
    </form>

    <script>
        function sendPostRequest(accessToken) {
            // Fields to be posted
            var fields = {
                'SiteID': 'API-001',
                'UserID': 'User-123456',
                'Names': 'John Smith',
                'Email': 'j.smith@gmail.com',
                'PhoneNumber': '8293244777',
                'Identification': '00520201129',
                'ReturnURL': 'https://sandbox-webpay.agilpay.net/',  // <--- your site URL
                'SuccessURL': 'https://sandbox-webpay.agilpay.net/Success',  // <--- your site Receipt URL
                'Detail': '{"Payments":[{"Items":[{"Description":"Service Invoice 122233","Quantity":"1","Amount":100,"Tax":0}],"MerchantKey":"TEST-001","Service":"ABC12345","MerchantName":"Test Store","Description":"Service Invoice 12233","Amount":123.55,"Tax":0,"Currency":"840"}]}',
                'token': accessToken
            };

            // Create a form
            var form = document.createElement('form');
            form.setAttribute('method', 'post');
            form.setAttribute('action', 'https://sandbox-webpay.agilpay.net/Payment');

            // Append fields to the form as hidden input elements
            for (var key in fields) {
                if (fields.hasOwnProperty(key)) {
                    var input = document.createElement('input');
                    input.setAttribute('type', 'hidden');
                    input.setAttribute('name', key);
                    input.setAttribute('value', fields[key]);
                    form.appendChild(input);
                }
            }

            // Append the form to the document body and submit
            document.body.appendChild(form);
            form.submit();
        }
		
		// get the JWT access token on server side 
        function getTokenAndSubmit() {
            // AJAX request to get access token from the server
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'getToken.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        var accessToken = xhr.responseText;
                        // Call function to send POST request with obtained access token
                        sendPostRequest(accessToken);
                    } else {
                        alert('Error: Unable to get Access Token.');
                    }
                }
            };
            xhr.send();
        }
    </script>
</body>
</html>
