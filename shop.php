<?php
include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:login.php');
}

if (isset($_POST['add_to_cart'])) {
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_category = $_POST['product_category'];
    $product_image = $_POST['product_image'];
    $product_quantity = $_POST['product_quantity'];

    $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

    if (mysqli_num_rows($check_cart_numbers) > 0) {
        $message[] = 'Already Added to Cart!';
    } else {
        mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, category, quantity, image) VALUES('$user_id', '$product_name', '$product_price', '$product_category', '$product_quantity', '$product_image')") or die('query failed');
        $message[] = 'Product Added to Cart!';
    }
}

// Initialize the WHERE clause for the query
$where_clause = '';

// Check if a category is selected
if (isset($_GET['category']) && !empty($_GET['category'])) {
    $selected_category = $_GET['category'];
    $where_clause = " WHERE category = '$selected_category'";
}

// Initialize the ORDER BY clause for sorting
$order_by_clause = '';

// Check if a sorting option is selected
if (isset($_GET['sort'])) {
    $sort_option = $_GET['sort'];
    switch ($sort_option) {
        case 'name_asc':
            $order_by_clause = " ORDER BY name ASC";
            break;
        case 'name_desc':
            $order_by_clause = " ORDER BY name DESC";
            break;
        case 'price_high':
            $order_by_clause = " ORDER BY price DESC";
            break;
        case 'price_low':
            $order_by_clause = " ORDER BY price ASC";
            break;
        default:
            // Handle other cases if needed
            break;
    }
}

// Initialize the search query
$search_query = '';

// Check if a search query is provided
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search_query = mysqli_real_escape_string($conn, $_GET['search']);
    if (!empty($where_clause)) {
        $where_clause .= " AND (name LIKE '%$search_query%' OR category LIKE '%$search_query%')";
    } else {
        $where_clause = " WHERE (name LIKE '%$search_query%' OR category LIKE '%$search_query%')";
    }
}

// Fetch products based on the category, sorting options, and search query
$select_products = mysqli_query($conn, "SELECT * FROM `products`" . $where_clause . $order_by_clause) or die('query failed');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>shop</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <?php include 'header.php'; ?>

    <div class="main-content">
        <div class="side-panel">
            <!-- Add your side panel content here -->

            <form action="" method="get" class="category-filter-form">
                <label for="search" class="box">Advanced Search:</label>
                <input type="text" name="search" id="search" placeholder="Enter keywords" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                <input type="submit" value="Search" class="btn">

                <label for="category" class="box">Filter by Category:</label>
                <select name="category" id="category" onchange="this.form.submit()">
                    <option value="" <?php if (!isset($_GET['category']) || $_GET['category'] === '') echo 'selected'; ?>>All Categories</option>
                    <?php
                    // Fetch unique categories from the database
                    $categories_query = mysqli_query($conn, "SELECT DISTINCT category FROM `products`") or die('query failed');
                    while ($category = mysqli_fetch_assoc($categories_query)) {
                        echo "<option value='{$category['category']}'";
                        if (isset($_GET['category']) && $_GET['category'] == $category['category']) {
                            echo ' selected';
                        }
                        echo ">{$category['category']}</option>";
                    }
                    ?>
                </select>
                <!-- Add the sorting dropdown -->
                <label for="sort" class="box">Sort by:</label>
                <select name="sort" id="sort" onchange="this.form.submit()">
                    <option value="name_asc" <?php if (isset($_GET['sort']) && $_GET['sort'] == 'name_asc') echo 'selected'; ?>>Name (A-Z)</option>
                    <option value="name_desc" <?php if (isset($_GET['sort']) && $_GET['sort'] == 'name_desc') echo 'selected'; ?>>Name (Z-A)</option>
                    <option value="price_high" <?php if (isset($_GET['sort']) && $_GET['sort'] == 'price_high') echo 'selected'; ?>>Price (High to Low)</option>
                    <option value="price_low" <?php if (isset($_GET['sort']) && $_GET['sort'] == 'price_low') echo 'selected'; ?>>Price (Low to High)</option>
                </select>
            </form>

            <!-- Add the Advanced Search heading here -->

            <!-- Add your advanced search options here -->
        </div>

        <div class="products">
            <div class="heading">
                <h3>our shop</h3>
                <p><a href="home.php">home</a> / shop </p>
            </div>

            <section class="products-list">
                <h1 class="title">latest products</h1>
                <div class="box-container">
                    <?php
                    // Use the $select_products fetched based on the category, sorting options, and search query
                    while ($fetch_products = mysqli_fetch_assoc($select_products)) {
                    ?>
                        <form action="" method="post" class="box">
                            <img class="image" src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
                            <div class="name"><?php echo $fetch_products['name']; ?></div>
                            <div class="category">Category: <?php echo $fetch_products['category']; ?></div>
                            <div class="price_shop">Price: $<?php echo $fetch_products['price']; ?>/-</div>
                            <input type="number" min="1" name="product_quantity" value="1" class="qty">
                            <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
                            <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
                            <input type="hidden" name="product_category" value="<?php echo $fetch_products['category']; ?>">
                            <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
                            <input type="submit" value="add to cart" name="add_to_cart" class="btn">
                        </form>
                    <?php
                    }
                    ?>
                </div>
            </section>
        </div>
    </div>

    <?php include 'footer.php'; ?>

    <!-- custom js file link  -->
    <script src="js/script.js"></script>

</body>

</html>
