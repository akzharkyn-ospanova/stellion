<?php include ('config/constants.php'); ?>

    <!DOCTYPE html>
    <html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Stellion</title>
        <link rel="stylesheet" href="css/styles.css">
    </head>
<body>

<section class="header">
    <div class="logo">
        <a href="<?php echo SITEURL; ?>" title="Logo">
            <img src="img/logo.png" alt="Logo">
        </a>
    </div>

    <div class="header-container">
        <p class="main-text">Надежные строительные материалы для вашего проекта</p>
        <p class="add-text">Качество, проверенное временем</p>
    </div>

    <div class="buttons">
        <button onclick="window.location.href='<?php echo SITEURL; ?>/index.php#contact-section'">Связаться с нами</button>
        <button onclick="window.location.href='<?php echo SITEURL; ?>/index.php#categories'">Каталог</button>
    </div>
</section>

<section class="products">
    <div class="container">
        <h1 class="products-title">Товары</h1>

        <?php
        include('config/constants.php');
        if(isset($_GET['category_id'])) {
            $category_id = $_GET['category_id'];
            $sql_category = "SELECT title FROM categories WHERE id = $category_id";
            $res_category = mysqli_query($conn, $sql_category);
            $row_category = mysqli_fetch_assoc($res_category);
            $category_title = $row_category['title'];

            echo "<h2 class='category-title'>Категория: " . htmlspecialchars($category_title) . "</h2>";

            $sql = "SELECT * FROM products WHERE category_id = $category_id AND active = 'Yes'";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);

            if ($count > 0) {
                echo "<div class='products-grid'>";
                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id'];
                    $title = $row['title'];
                    $image_name = $row['image_name'];
                    $description = $row['description'];
                    $price = $row['price'];
                    ?>
                    <div class="product" onclick="openModal('<?php echo htmlspecialchars($title); ?>', '<?php echo htmlspecialchars($description); ?>', '<?php echo $price; ?>', '<?php echo SITEURL; ?>/images/product/<?php echo $image_name; ?>')">
                        <img src="<?php echo SITEURL; ?>/images/product/<?php echo $image_name; ?>" alt="<?php echo htmlspecialchars($title); ?>">
                        <h3><?php echo htmlspecialchars($title); ?></h3>
                    </div>
                    <?php
                }
                echo "</div>";
            } else {
                echo "<div class='error'>Товары не найдены</div>";
            }
        } else {
            echo "<div class='error'>Категория не выбрана</div>";
        }
        ?>
    </div>
</section>

<!-- Модальное окно -->
<div id="product-modal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <img id="modal-img" src="" alt="Product Image">
        <h2 id="modal-title"></h2>
        <p id="modal-description"></p>
        <p id="modal-price"></p>
    </div>
</div>

<script>
    function openModal(title, description, price, image_name) {
        document.getElementById("modal-title").innerText = title;
        document.getElementById("modal-description").innerText = description;
        document.getElementById("modal-price").innerText = "Цена: " + price + " ₽";
        document.getElementById("modal-img").src = image_name;
        document.getElementById("product-modal").style.display = "block";
    }

    function closeModal() {
        document.getElementById("product-modal").style.display = "none";
    }
</script>

<?php include ('partials-front/footer.php'); ?>