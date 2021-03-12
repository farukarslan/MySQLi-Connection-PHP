<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

        <title>PHP - MySQL</title>
    </head>
    <body>
        <h1>PHP - MySQLi Limit Data ve Pagination(Sayfalama)</h1>
        <?php
            
            if (isset($_GET["page"]) && isset($_GET["count"])) {
                $page = $_GET["page"];
                $count = $_GET["count"];
            }
            else{
                print("You must enter page and count info to the end of link like this: ?page=1&count=20 <br/>");
                print("Kaçıncı sayfadan başlayacak ve her sayfada kaç satır bilgi olacak bu bilgileri linkin sonuna
                    ?page=1&count=20 olarak eklemelisiniz! <br/><br/>");
            }
            
            $bag = new mysqli("localhost","root","","classicmodels");

            if($bag->connect_error){
                die("Bağlantı hatası: " . $bag->connect_error);
            }
            
            $sql = "SELECT count(*) as toplam FROM customers";
            $sonuc = $bag->query($sql);
            $row = $sonuc->fetch_assoc();
            $kayit_sayisi = $row["toplam"];
            $pages = ceil($kayit_sayisi / $count);
            $start = ($page - 1)*($count);

            print("<nav aria-label=\"Page navigation example\"><ul class=\"pagination\">");
            for ($i=1; $i < $pages ; $i++) { 
                if ($i == $page) {
                    print("<li class=\"page-item active\">");           
                }
                else{
                    print("<li class=\"page-item \">");
                }
                print("<a class='page-link'href=\"". $_SERVER["PHP_SELF"]."?page=".$i."&count=".$count ."\">$i</a></li>");
            }            
            print("</ul></nav>");

            if ($kayit_sayisi > 0) {
                $sql = "SELECT * FROM customers LIMIT $start, $count";
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
            }
            $bag->close();
        ?>
    </body>
</html>