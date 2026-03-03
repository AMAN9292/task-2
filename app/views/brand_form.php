

<!DOCTYPE html>
<html>
<head>
    <title>Add Brand</title>
    <link rel="stylesheet" href="/n2-php/public/assets/custom.css">

    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background: #f4f4f4;
            font-family: Arial, sans-serif;
        }

        .form-box {
            background: #fff;
            padding: 25px 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            width: 320px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-top: 10px;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="file"] {
            width: 100%;
            padding: 6px;
        }

        button {
            margin-top: 15px;
            width: 100%;
            padding: 8px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background: #0056b3;
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>

<body>

<div class="form-box">
    <h2>Add Brand</h2>

    <form method="POST" action="brand.php?action=store" enctype="multipart/form-data">

        <label>Brand Name:</label>
        <input type="text" name="br_name">
        <span style="color:red"><?= $errors['br_name'] ?? '' ?></span>

        <label>Image:</label>
        <input type="file" name="image">

        <button type="submit">Save</button>
    </form>

    <a href="brand.php" class="back-link">Back</a>
</div>

</body>
</html>