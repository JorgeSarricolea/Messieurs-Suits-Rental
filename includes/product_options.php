<!-- Main CSS File -->
<link rel="stylesheet" href="../styles/product_options.css">
<link rel="stylesheet" href="../styles/admin_tables.css">
<link rel="stylesheet" href="../styles/main.css">

<!-- To get the current page path -->
<?php
$current_page = basename($_SERVER['PHP_SELF']);

$pagesWithTable = ['suits.php', 'suit_jackets.php', 'suit_pants.php', 'shirts.php', 'ties.php', 'shoes.php'];
$is_table_visible = in_array($current_page, $pagesWithTable);
?>

<nav id="product-options" class="<?php echo $is_table_visible ? 'with-table' : ''; ?>">
    <ul class="<?php echo $is_table_visible ? 'with-table' : ''; ?>">
        <?php
        // Define links and their associated icons
        $links = [
            'suits.php' => ['Trajes', 'https://img.icons8.com/external-wanicon-solid-wanicon/64/external-suit-autumn-clothes-accesories-wanicon-solid-wanicon.png" alt="external-suit-autumn-clothes-accesories-wanicon-solid-wanicon'],
            'suit_jackets.php' => ['Sacos', 'https://img.icons8.com/external-wanicon-solid-wanicon/64/external-suit-autumn-clothes-accesories-wanicon-solid-wanicon.png" alt="external-suit-autumn-clothes-accesories-wanicon-solid-wanicon'],
            'suit_pants.php' => ['Pantalones', 'https://img.icons8.com/glyph-neue/64/trousers.png'],
            'shirts.php' => ['Camisas', 'https://img.icons8.com/external-kiranshastry-solid-kiranshastry/64/external-ironed-cleaning-kiranshastry-solid-kiranshastry.png" alt="external-ironed-cleaning-kiranshastry-solid-kiranshastry'],
            'ties.php' => ['Corbatas', 'https://img.icons8.com/external-kiranshastry-solid-kiranshastry/64/external-tie-man-accessories-kiranshastry-solid-kiranshastry.png" alt="external-tie-man-accessories-kiranshastry-solid-kiranshastry'],
            'shoes.php' => ['Zapatos', 'https://img.icons8.com/external-those-icons-fill-those-icons/96/external-shoe-wedding-those-icons-fill-those-icons-1.png" alt="external-shoe-wedding-those-icons-fill-those-icons-1']
        ];

        // Generate list items for each link
        foreach ($links as $link => $data) {
            $pageName = $data[0];
            $icon = $data[1];
            $isActive = ($current_page === $link);
            $class = $isActive ? 'current' : '';
            ?>
            <li class="<?php echo $class . ($is_table_visible ? ' with-table' : ''); ?>" >
                <img class="<?php echo $is_table_visible ? 'with-table' : ''; ?>" width="64" height="64" src="<?php echo $icon; ?>" alt="<?php echo $icon; ?>"/>
                <a href="./<?php echo $link; ?>"><?php echo $pageName; ?></a>
            </li>
            <?php
        }
        ?>
    </ul>
</nav>
