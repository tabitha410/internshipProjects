<?php 
    $firstNum = $_POST["firstNum"];
    $secondNum = $_POST["secondNum"];
    $operator = $_POST["operator"];
    $output = "";
    $sign = "";

    if(is_numeric($firstNum) && is_numeric($secondNum)){
         switch ($operator){
                case "Add":
                    $output = $firstNum + $secondNum;
                    break;
                case "Subtract":
                    $output = $firstNum - $secondNum;
                    break;
                case "Multiply":
                    $output = $firstNum * $secondNum;
                    break;
                case "Divide":
                    if($secondNum==0){
                        $output = "undefined";
                    } else{
                        $output = $firstNum / $secondNum;
                    }
                    break;
                default:
                    echo "Invalid";
            }
            echo '
            <form action="back.php" method="post">
        <h5>
        First Number<br>
        <input type="number" name="firstNum" id="firstNum" required value = "'.$firstNum.'">
        </h5>

        <h5>
            Second Number<br>
            <input type="number" name="secondNum" id="secondNum" required value = "'.$secondNum.'">
        </h5>

        <button type="submit" name = "operator" value = "Add">Add</button>
        <button type="submit" name = "operator" value = "Subtract">Subtract</button>
        <button type="submit" name = "operator" value = "Multiply">Multiply</button>
        <button type="submit" name = "operator" value = "Divide">Divide</button>
    </form>
            <div>Result:</div>'.$output;
        }
        
        

    
    
?>