<?php
// 🔸 1. Database connection
$conn = mysqli_connect("localhost", "root", "", "db_product");

// 🔸 2. Query
$data = mysqli_query($conn, "
    SELECT b.br_name, COUNT(p.id) AS total_products
    FROM brand b
    LEFT JOIN db_product p ON p.brand_id = b.id
    GROUP BY b.id
");
?>

<!-- 🔸 3. HTML Table -->
 <html>
<table border="1">
    <tr>
        <th>Brand Name</th>
        <th>Total Products</th>
    </tr>

    <?php while ($row = mysqli_fetch_assoc($data)) { ?>
        <tr>
            <td><?php echo $row['br_name']; ?></td>
            <td><?php echo $row['total_products']; ?></td>
        </tr>
    <?php } ?>
</table>
</html>