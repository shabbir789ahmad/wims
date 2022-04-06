INSERT INTO `wims`.`products`(`id`, `category_id`, `sub_category_id`, `product_name`, `product_code`, `product_weight`, `unit_id`, `sell_by`, `product_image`, `created_at`, `updated_at`) SELECT `id`, `category_id`, `sub_category_id`, `product_name`, `product_code`, `product_weight`, `unit_id`, `sell_by`, `product_image`, `created_at`, `updated_at` FROM `wims2`.`products`;

<!-- for multiple culmn  -->

INSERT INTO `wims`.`product_stocks`(`id`, `pbrand_id`, `stock`, `stock_sold`, `product_price_piece`, `product_price_piece_wholesale`, `product_price_unit`, `product_price_unit_wholesale`, `purchasing_price`, `created_at`, `updated_at`) SELECT `product_stocks`.`id`, `product_stocks`.`pbrand_id`, `product_stocks`.`stock`,`product_stocks`. `stock_sold`, `product_price_piece`, `product_price_piece_wholesale`, `product_price_unit`, `product_price_unit_wholesale`, `purchasing_price`, `product_stocks`.`created_at`, `product_stocks`.`updated_at` FROM `wims2`.`product_brands`
 JOIN `product_stocks` ON `product_stocks`.`pbrand_id` = `product_brands`.`Id`;
<!DOCTYPE html>




<!-- Created By CodingNepal -->
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>Animated Drop-down Menu CSS3</title>
      <link rel="stylesheet" href="style.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
      <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
   </head>
   <style type="text/css">
      @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');
*{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  user-select: none;
  font-family: 'Poppins', sans-serif;
}
nav{
  position: absolute;
  top: 20%;
  left: 50%;
  transform: translate(-50%, -50%);
  background: #1b1b1b;
  width: 400px;
  line-height: 40px;
  padding: 8px 25px;
  border-radius: 5px;
}
nav label{
  color: white;
  font-size: 22px;
  font-weight: 500;
  display: block;
  cursor: pointer;
}
.button span{
  float: right;
  line-height: 40px;
  transition: 0.5s;
}
.button span.rotate{
  transform: rotate(-180deg);
}
nav ul{
  position: absolute;
  background: #1b1b1b;
  list-style: none;
  top: 75px;
  left: 0;
  width: 100%;
  border-radius: 5px;
  display: none;
}
[id^=btn]:checked + ul{
  display: block;
}
nav .menu:before{
  position: absolute;
  content: '';
  height: 20px;
  width: 20px;
  background: #1b1b1b;
  right: 20px;
  top: -10px;
  transform: rotate(45deg);
  z-index: -1;
}
nav ul li{
  line-height: 40px;
  padding: 8px 20px;
  cursor: pointer;
  border-bottom: 1px solid rgba(0,0,0,0.2);
}
nav ul li label{
  font-size: 18px;
}
nav ul li a{
  color: white;
  text-decoration: none;
  font-size: 18px;
  display: block;
}
nav ul li a:hover,
nav ul li label:hover{
  color: cyan;
}
nav ul ul{
  position: static;
}
nav ul ul li{
  line-height: 30px;
  padding-left: 30px;
  border-bottom: none;
}
nav ul ul li a{
  color: #e6e6e6;
  font-size: 17px;
}

input{
  display: none;
}
   </style>
   <body>
      <nav>
         <label for="btn" class="button">Drop down
         <span class="fas fa-caret-down"></span>
         </label>
         <input type="checkbox" id="btn">
         <ul class="menu">
            <li><a href="#">Home</a></li>
          <li><a href="#">Contact</a></li>
            <li><a href="#">Feedback</a></li>
         </ul>
      </nav>
      <!-- This code used to rotate drop icon(-180deg).. -->
      <script>
         $('nav .button').click(function(){
           $('nav .button span').toggleClass("rotate");
         });
           $('nav ul li .first').click(function(){
             $('nav ul li .first span').toggleClass("rotate");
           });
           $('nav ul li .second').click(function(){
             $('nav ul li .second span').toggleClass("rotate");
           });
      </script>
   </body>
</html>


427155a21ccc7c9b