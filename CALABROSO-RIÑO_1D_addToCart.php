<?php
session_start();
?>
<!DOCTYPE>
<html>
<head>
    <title>SHOPPING CART TEST</title>
    <meta charset="utf-8" />
    <style>
        body {
			font-family: Tahoma;
			color: #FFD6C0;
            background-color: #D64933;
            padding-top: 45px;
        }
        div {
            text-align: center;
            
        }
        fieldset {
           
            background-color:#003844;
            margin-left: auto;
            margin-right: auto;
        }
        
        table {
            font-size: 1.50em;
            text-align: center;
            margin-left: auto;
            margin-right: auto;
            width: 50%;
        }
        h1{
                font-family: Verdana;
	            color: #FFD6C0;
	            font-size: 60px;
                text-align:center;  
                letter-spacing: 8px;
            }
        
        .A {
            border-left: 2px solid #FFD6C0;
            border-right: 2px solid #FFD6C0;
            border-top: 2px solid #FFD6C0;
            border-bottom: 2px solid #FFD6C0;
            background-color: #003844;
        }
        .B {
            border-left: 2px solid #FFD6C0;
            border-right: 2px solid #FFD6C0;
            border-top: 2px solid #FFD6C0;
            border-bottom: 2px solid #FFD6C0;
            background-color: #003844;
        }
        .Main {
            font: 2.6em sans-serif;
            border-left: 2px solid #FFD6C0;
            border-right: 2px solid #FFD6C0;
            border-top: 10px solid #FFD6C0;
            border-bottom: 2px solid #FFD6C0;
            background-color: #FFD6C0;
            color: #003844;
        }	


    </style>
</head>
<body>
    <div>
    <link rel="stylesheet"  type="text/css" href="" />
    <h1>Items Available</h1>
    <fieldset style="width:400px">
    <form action="" method="post">
        <Table>  
            <tr><th>Item:</th><th>Quantity:</th></tr>
            <tr><td>Apple</td><td><input type="text" name="apple" size="5"></td></tr>
            <tr><td>Banana</td><td><input type="text" name="banana" size="5"></td></tr>
            <tr><td>Amount Paid:</td><td><input type="text" name="amount" size="5"></td></tr>
            
   
        </table>
        <br>
        <input type="submit" value="Click to add to cart">
    </form>
    
    </fieldset>
 
    <br>
<?php 
        $apple = $banana = $payment = "";
        
        if (isset($_POST['apple'])) {
            $apple = $_POST['apple'];
            if (is_numeric($_POST['apple'])) {
                $_SESSION['cart']['apple'] = $_POST['apple'];
            }
   
            elseif ($_POST['apple'] == "Remove") {
                unset($_SESSION['cart']['apple']);
            }
        }
        
        if (isset($_POST['banana'])) {
            $banana = $_POST['banana'];
            if (is_numeric($_POST['banana'])) {
                $_SESSION['cart']['banana'] = $_POST['banana'];
            }
            elseif ($_POST['banana'] == "Remove") {
                unset($_SESSION['cart']['banana']);
            }
        }
        if (!isset($_POST['amount'])) {
            echo "No Payment has been made\n";
        }
        else {
            $payment = $_POST['amount'];
        }

?>
    <?php
        define("PriceOfApple", 25.75);
        define("PriceOfBanana", 15.50);
        $vatsale = VatableSales($apple, $banana);
        $vat12 = Vat($apple, $banana);
        $totalsale = $vatsale + $vat12; 
        $vatableform = number_format($vatsale, 2);
        $vat12form = number_format($vat12, 2);
        $totalsaleform = number_format($totalsale, 2);
        $changeform = number_format(((float)$payment - (float)$totalsaleform), 2);

        function VatableSales($a, $b) {
            $vatableform = (((float)$a * PriceOfApple) + ((float)$b * PriceOfBanana)) / 1.12;
            return $vatableform;
        }
        function Vat($a, $b) {
            $vat12form = ((((float)$a * PriceOfApple) + ((float)$b * PriceOfBanana)) - (((float)$a * PriceOfApple) + ((float)$b * PriceOfBanana)) / 1.12);
            return $vat12form;
        }

    ?>

    <fieldset style="width:100px">
    <legend>Your Shopping Cart</legend>
    <?php
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
            echo "Your shopping cart is empty\n";
        }

        else {
            echo "<form action=\"CALABROSO-RIÑO_1D_addToCart.php\" method=\"post\">\n";
            echo "<table>\n";
            echo "<tr><th>Item</th><th>Quantity</th><th/></tr>\n";
            
            foreach($_SESSION['cart'] as $key => $value) {
                echo "<tr><td>$key</td><td>$value</td>\n";
                echo "<td><input type=\"submit\" name=\"$key\"
                value=\"Remove\"></td></tr>\n";
            }
        echo "</table>\n";
        echo "</form>\n";
        }
    ?>
    </fieldset>
    
    <br>
    <?php
        echo "<table>";
        echo "<tr><th class='Main' colspan='6'>Receipt</th></tr>";
        echo "<tr><th class='A' colspan='3'>Vatable Sales:</th>
        <th class='A' colspan='3'>$vatableform</th>";
        echo "<tr><th class='B' colspan='3'>Vat 12%:</th>
        <th class='B' colspan='3'>$vat12form</th>";
        echo "<tr><th class='A' colspan='3'>Total Sales:</th>
        <th class='A' colspan='3'>$totalsaleform</th>";
        echo "<tr><th class='A' colspan='3'>Change:</th>
        <th class='A' colspan='3'>$changeform</th>";
    ?>
    </div>
</body>
</html>
