<?php include ('partials-front/menu.php') ?>


    <section class="categories" id="categories">
    <h1 class="catalog-text">Каталог</h1>
    <div class="container">

        <?php
        $sql = "SELECT * FROM `categories` WHERE active = 'Yes' AND featured = 'Yes'";
        $res = mysqli_query($conn, $sql);

        $count = mysqli_num_rows($res);

        if ($count > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                $id = $row['id'];
                $title = $row['title'];
                $description = $row['description'];
                $image = $row['image_name'];
                ?>

                <a href="<?php echo SITEURL; ?>/products.php?category_id=<?php echo $id; ?>" class="view-products-btn">
                    <div class="box-3 float-container">
                        <?php if ($image != "") { ?>
                            <img src="<?php echo SITEURL; ?>/images/category/<?php echo $image; ?>" alt="">
                        <?php } else { ?>
                            <div class='error'>Image not Available</div>
                        <?php } ?>

                        <h3 class="category-name"><?php echo $title; ?></h3>
                        <p class="category-desc"><?php echo $description; ?></p>
                    </div>
                </a>

                <?php
            }
        } else {
            echo "<div class='error'>Category not added</div>";
        }
        ?>
    </div>
    </section>




    <div id="product-modal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <img id="modal-img" src="" alt="Product Image">
            <h2 id="modal-title"></h2>
            <p id="modal-description"></p>
            <p id="modal-price"></p>
        </div>
    </div>




    <section class="contact-section" id="contact-section">
        <div class="container">
            <div class="column-left">
                <h1 class="column-text">Cвязаться с нами</h1>
                <div class="info-about-us">
                    <div class="address info">
                        <img src="img/loaction.png" alt="">
                        <p class="info-text">Address</p>
                    </div>
                    <div class="number info">
                        <img src="img/phone.png" alt="">
                        <p class="info-text">+7 777 777 77 77</p>
                    </div>
                    <div class="mail info">
                        <img src="img/mail.png" alt="">
                        <p class="info-text">mail@gmail.com</p>
                    </div>
                </div>
            </div>
            <div class="column-right">
                <h3 class="column-text">С вами свяжутся как можно скорее</h3>
                <div class="separator"></div>
                <div class="form-container">
                    <form id="orderForm" action="admin/manage-order.php" method="POST">
                        <input type="text" name="first_name" placeholder="Введите ваше имя" required>
                        <input type="text" name="last_name" placeholder="Введите вашу фамилию" required>
                        <input type="tel" name="phone" placeholder="Введите ваш номер телефона в WhatsApp" required>
                        <button type="submit">Отправить</button>
                    </form>
                </div>
            </div>
        </div>
    </section>


    <script>
        document.getElementById("orderForm").addEventListener("submit", function(event) {
            event.preventDefault();

            let formData = new FormData(this);

            fetch("admin/manage-order.php", {
                method: "POST",
                body: formData
            })
                .then(response => response.text())
                .then(data => {
                    alert("Заявка отправлена!");
                    document.getElementById("orderForm").reset();
                })
                .catch(error => {
                    alert("Ошибка при отправке заявки! Попробуйте снова.");
                    console.error("Ошибка:", error);
                });
        });
    </script>


<?php include ('partials-front/footer.php') ?>