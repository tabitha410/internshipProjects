<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Calculator</title>
</head>
<body>
    <header><h1> Simple Php Calculator</h1></header>

    <form action="back.php" method="post">
        <h5>
        First Number<br>
        <input type="number" name="firstNum" id="firstNum" required value = ""> 
        </h5>

        <h5>
            Second Number<br>
            <input type="number" name="secondNum" id="secondNum" required value = "">
        </h5>

        <button type="submit" name = "operator" value = "Add">Add</button>
        <button type="submit" name = "operator" value = "Subtract">Subtract</button>
        <button type="submit" name = "operator" value = "Multiply">Multiply</button>
        <button type="submit" name = "operator" value = "Divide">Divide</button>
    </form>


</body>
</html>