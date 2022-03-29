<?php
     
//array to pass to table
$sampleArray = array(
    0 => "DOG", 
    1 => 123,  
)
?>


<!DOCTYPE html>
<html>
  <head>
    <title>Title of the document</title>
  </head>
  <body>
    <form>

        
        <input type="button" value="Generate a table." onclick="generate_table()">
        <hr />
        <div id="dvTable"></div>

    </form>
  </body>
</html>



<script type="text/javascript">
    function generate_table() {

    //access php array
    var passedArray = <?php echo json_encode($sampleArray); ?>;

    // get the reference for the body
    var body = document.getElementsByTagName("body")[0];

    // creates a <table> element and a <tbody> element
    var tbl = document.createElement("table");
    var tblBody = document.createElement("tbody");

    var coins = new Array();
    coins.push(["Coin", "Price"]);
    //comment these out when it works, here for testing table
    coins.push(['BTC',100]);
    coins.push(["ETH", 150])
    //add the passed PHP array
    coins.push(passedArray)
    
    // creating all cells
    for (let x in coins) {
        // creates a table row
        var row = document.createElement("tr");

        for (let y in coins[x]) {
        // Create a <td> element and a text node, make the text
        // node the contents of the <td>, and put the <td> at
        // the end of the table row
        var cell = document.createElement("td");
        var cellText = document.createTextNode(coins[x][y]);
        cell.appendChild(cellText);
        row.appendChild(cell);
        }

        // add the row to the end of the table body
        tblBody.appendChild(row);
    }

    // put the <tbody> in the <table>
    tbl.appendChild(tblBody);
    // appends <table> into <body>
    body.appendChild(tbl);
    // sets the border attribute of tbl to 2;
    tbl.setAttribute("border", "2");

    var dvTable = document.getElementById("dvTable");
    dvTable.innerHTML = "";
    dvTable.appendChild(tbl);
    }
</script>