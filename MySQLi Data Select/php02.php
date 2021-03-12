<html>
    <head>
        <title>PHP - MySQL</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    </head>
    <body>
        <h1>PHP - MySQLi Veri Seçme(Select) - Listeleme</h1>
        <?php
            $bag = new mysqli("localhost","root","","classicmodels");

            if($bag->connect_error){
                die("Bağlantı hatası: " . $bag->connect_error);
            }
            
             $sql = "SELECT * FROM customers";
             $sonuc = $bag->query($sql);
             if ($sonuc->num_rows > 0) {
                print("<table class=\"table table-hover\">");
                print("<thead><tr><th scope=\"col\">Müşteri Numarası</th><th scope=\"col\">Adı</th><th scope=\"col\">Soyadı</th>
                <th scope=\"col\">İlk Adı</th><th scope=\"col\">Telefon</th></tr></thead>");
                print("<tbody>");
                while ($row = $sonuc->fetch_assoc()) {
                    print("<tr>");
                    print("<td>" . $row["customerNumber"] . "</td>");
                    print("<td>" . $row["customerName"] . "</td>");
                    print("<td>" . $row["contactLastName"] . "</td>");
                    print("<td>" . $row["contactFirstName"] . "</td>");
                    print("<td>" . $row["phone"] . "</td>");
                    print("</tr>");
                }
                print("</tbody>");
                print("</table>");
             }
             else{
                 print("Sıfır sonuç...");
             }

            $bag->close();
        ?>
    </body>
</html>