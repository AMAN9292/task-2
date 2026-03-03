

<!DOCTYPE html>
<html>
<head>
    <title>Edit Brand</title>
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
            background: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background: #1e7e34;
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 10px;
        }

        .preview {
            text-align: center;
            margin-top: 10px;
        }

        .preview img {
            max-width: 100px;
            margin-top: 5px;
        }
    </style>
</head>

<body>

<div class="form-box">
    <h2>Edit Brand</h2>

    <form method="POST" action="brand.php?action=update&id=<?= $brand['id'] ?>" enctype="multipart/form-data">

        <label>Brand Name:</label>
        <input type="text" name="br_name" value="<?= $brand['br_name'] ?>">
        <span style="color:red"><?= $errors['br_name'] ?? '' ?></span>

        <label>Current Image:</label>
        <div class="preview">
            <img src="/n2-php/public/uploads/<?= $brand['image'] ?>" alt="">
        </div>

        <label>Change Image:</label>
        <input type="file" name="image">

        <button type="submit">Update</button>
    </form>

    <a href="brand.php" class="back-link">Back</a>
</div>

</body>
</html>