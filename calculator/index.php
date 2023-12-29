<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>PHP Calculator</title>
</head>
<body>
   <div class="main">
    <div class="container text-center mt-5">
        <h1>PHP Calculator</h1>
        <div class="d-flex align-center justify-content-center align-items-center mt-5">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="input-group input-group-lg mb-3">
                    <input required type="number" name="num01" placeholder="Number one" class="form-control">
                    <select name="operator" class="form-control">
                        <option value="add">+</option>
                        <option value="subtract">-</option>
                        <option value="multiply">*</option>
                        <option value="divide">/</option>
                    </select>
                    <input required type="number" name="num02" placeholder="Number two" class="form-control">
                    <button class="btn btn-primary">Calculate</button>
                </div>
            </form>
        </div>
        
        <?php
        // 1. Check if user input isn't empty, then sanitize user input. 
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $num01 = filter_input(INPUT_POST, "num01", FILTER_SANITIZE_NUMBER_FLOAT );
            $num02 = filter_input(INPUT_POST, "num02", FILTER_SANITIZE_NUMBER_FLOAT );
            $operator = htmlspecialchars(($_POST["operator"]));

            // 2. Error handlers
            $errors = false;
            // 3. Make sure no fields are empty. 
            if (empty($num01) || empty($num02) || empty($operator)) {
                echo "<p class='text-center text-danger'>All fields are required!</p>";
                $errors = true;
            }
            // 4. Check the user input data type
            if (!is_numeric($num01) || !is_numeric($num02)) {
                echo "<p class='text-center text-danger'>Numbers only!</p>";
                $errors = true;
            }
            // Calculate the numbers if no error
            if (!$errors) {
                $value = 0; // Without assigning a default value, the error message will be output. 
                
                switch ($operator) {
                    case 'add':
                        $value = $num01 + $num02;
                        break;
                    case 'subtract':
                        $value = $num01 - $num02;
                        break;
                    case 'multiply':
                        $value = $num01 * $num02;
                        break;
                    case 'devide':
                        $value = $num01 / $num02;
                        break;
                    default:
                        echo "<p class='--bs-danger-text-emphasis'>Something went wrong!</p>";
                        break;
                }
                echo "<p class='pt-4 text-center fs-1 result'>Result = " . $value . "</p>";
            }
        }
        ?>

    </div>
   </div>
    
</body>
</html>