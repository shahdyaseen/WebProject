<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $section = $_POST['section'];
    $type = ' ';

    switch ($section) {
        case 'hoodies':
            $type = 'هودي';
            break;
        case 'mugs':
            $type = 'كوب';
            break;
        case 'bags':
            $type = 'حقيبة';
            break;
        default:
            echo "<h2>محتوى غير معروف</h2><p>يرجى اختيار قسم صحيح.</p>";
            exit;
    }

    $c = mysqli_connect("localhost", "root", "", "7akora");
    $q = "SELECT * FROM products WHERE type ='$type';";
    $x = mysqli_query($c, $q);
    $data = array();

    while ($a = mysqli_fetch_assoc($x)) {
        $data[] = $a;
    }

    ?>
    <section id="mugs" >
        <div class="container page-wrapper">
            <div class="page-inner">
                <div class="row">
                    <?php
                    foreach ($data as $product) {
                        if (!empty($product)) {
                            $id = $product['PID'];
                            $pname = $product['pname'];
                            $type = $product['type'];
                            $description = $product['description'];
                            $price = $product['price'];
                            $pic = $product['pic'];




                            echo "

            <div class='el-wrapper'>
                <div class='box-up'>
                    <button class='buttonGoToProductPage' onclick='goToProductPage()'><img class='img' src='$pic' alt=''> </button>
                    <div class='img-info'>
                        <div class='info-inner'>
                            <span class='p-name'>$pname</span>
                            <span class='p-company'>حاكورة</span>
                        </div>
                        <div class='a-size'>المقاسات المتوفرة :<span class='size'>S , M , L , XL</span></div>
                    </div>
                </div>
                <div class='box-down'>
                    <div class='h-bg'>
                        <div class='h-bg-inner'></div>
                    </div>
                    <a class='cart' href='#' onclick='addToCart(event, $id)'>
                        <span class='price'>$price</span>
                        <span class='add-to-cart'>

                        </span>
                    </a>
                </div>
                 
                    <input  id='cartButton' type='submit' name=$id value='اضف الى السلة'>
                                    
            </div>
            ";
                        }

                    }

                    ?>
                </div>
            </div>
        </div>
    </section>
    <?php
}
?>
