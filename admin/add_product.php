<?php
// Check if the user is an administrator
include './isAdmin.php'
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Main CSS File -->
  <link rel="stylesheet" href="../styles/product_options.css">
  <title>Nuevo producto</title>
</head>
<body>
<?php include '../includes/side_menu.php'?>
<nav id="product-options">
    <ul>
        <?php
        // Define links and their associated icons
        $links = [
            'suit_details.php' => ['Trajes', 'https://img.icons8.com/external-wanicon-solid-wanicon/64/external-suit-autumn-clothes-accesories-wanicon-solid-wanicon.png" alt="external-suit-autumn-clothes-accesories-wanicon-solid-wanicon'],
            'suit_jacket_details.php' => ['Sacos', 'https://img.icons8.com/external-wanicon-solid-wanicon/64/external-suit-autumn-clothes-accesories-wanicon-solid-wanicon.png" alt="external-suit-autumn-clothes-accesories-wanicon-solid-wanicon'],
            'suit_pant_details.php' => ['Pantalones', 'https://img.icons8.com/glyph-neue/64/trousers.png'],
            'shirt_details.php' => ['Camisas', 'https://img.icons8.com/external-kiranshastry-solid-kiranshastry/64/external-ironed-cleaning-kiranshastry-solid-kiranshastry'],
            'tie_details.php' => ['Corbatas', 'https://img.icons8.com/external-kiranshastry-solid-kiranshastry/64/external-tie-man-accessories-kiranshastry-solid-kiranshastry'],
            'shoe_details.php' => ['Zapatos', 'https://img.icons8.com/external-those-icons-fill-those-icons/96/external-shoe-wedding-those-icons-fill-those-icons-1.png']
        ];

        // Get the current page
        $current_page = basename($_SERVER['PHP_SELF']);

        // Generate list items for each link
        foreach ($links as $link => $data) {
            $pageName = $data[0];
            $icon = $data[1];
            $isActive = ($current_page === $link);
            $class = $isActive ? 'current' : '';
        ?>
        <li class="<?php echo $class; ?>">
            <img width="64" height="64" src="<?php echo $icon; ?>" alt="<?php echo $icon; ?>"/>
            <a href="./<?php echo $link; ?>"><?php echo $pageName; ?></a>
        </li>
        <?php
        }
        ?>
    </ul>
</nav>

</body>
</html>
