<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <title>PHP - MySQL</title>
    <script>
        function showHint(str) {
            if (str.length < 3) {
                document.getElementById("txtHint").innerHTML = "<br/>En az 3 karakter giriniz...";
                return;
            } 
            else {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("txtHint").innerHTML = this.responseText;
                }
            }
            xmlhttp.open("GET", "php05.php?q=" + str, true);
            xmlhttp.send();
            }
        }
    </script>
</head>
<body>
    <h1>PHP - AJAX</h1>        
    <p><b>Arama işlemi için yazmaya başlayın:</b></p>
    <form action="">
        <label for="fname">Arama: </label>
        <input type="text" id="fname" name="fname" onkeyup="showHint(this.value)">
    </form>
    <div id="txtHint"></div>

</body>
</html>