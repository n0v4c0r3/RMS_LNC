<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initialscale=
1.0">
<title>Document</title>

</head>
<body>
<table id="dataTable">
    <tr>
        <th>name</th>
        <th>qty</th>
        <th>price</th>
    </tr>
    <tr>
        <td>T-Shirt</td>
        <td>100</td>
        <td>2</td>
        
    </tr>
    <tr>
        <td>shirt</td>
        <td>150</td>
        <td>5</td>
        
    </tr>
    <tr>
        <td>pant</td>
        <td>500</td>
        <td>4</td>
        
    </tr>
</table>

<p id="write"></p>
<script>
    var array = [];
    var headers = [];
    $('#dataTable th').each(function(index, item) {
        headers[index] = $(item).html();
    });
    $('#dataTable tr').has('td').each(function() {
        var arrayItem = {};
        $('td', $(this)).each(function(index, item) {
            arrayItem[headers[index]] = $(item).html();
        });
        array.push(arrayItem);
    });

console.log(JSON.stringify(array));

</script>
</body>
</html>