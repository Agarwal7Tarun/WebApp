<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>about</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>about us</h3>
   <p> <a href="home.php">home</a> / about </p>
</div>

<section class="about">

   <div class="flex">

      <div class="image">
         <img src="images/about-img.jpg" alt="">
      </div>

      <div class="content">
         <h3>Welcome to InkFeather: Where the pages come alive and dreams take flight</h3>

         <p>At InkFeather, we believe in the transformative power of words. Nestled in the heart of literary exploration, we are more than just a bookstore; we are a haven for book lovers, dreamers, and avid readers alike. 
            Our passion for storytelling led us to curate a collection of books that transcend genres, inviting you to embark on journeys that ignite the imagination and stir the soul.</p>
         <h3>Our Story</h3>
         <p>InkFeather began with a simple yet profound idea: to create a space where the magic of literature could thrive. Born out of our love for the 
            written word, we envisioned a sanctuary for book enthusiasts to discover new worlds, connect with beloved characters, and explore the endless 
            possibilities that books unfold.<br>Established in 2023, InkFeather has since evolved into a curated online bookstore that celebrates the art
            of storytelling in all its forms. Our shelves are carefully stocked with a diverse array of titles, from timeless classics to contemporary bestsellers, 
            ensuring there's something for every reader.</p>

         <h3>Our Commitment</h3>

         <p> the core of InkFeather is a commitment to fostering a community of readers who share a deep appreciation for the written word. We believe that books
               have the power to inspire, educate, and unite people from all walks of life. Our mission is to be your literary companion on this journey, offering not
               just books but a gateway to endless possibilities and worlds waiting to be explored.</p>

         <h3>Why Choose InkFeather?</h3>

         <p>Curated Selection: Our team of passionate readers carefully selects each book, ensuring that every title on our shelves is a gem waiting to be 
            discovered.<br> Quality and Excellence: We are dedicated to providing you with the highest quality books and an exceptional shopping experience.
            <br>Community Hub: Join our community of fellow book lovers, where discussions, recommendations, and literary adventures await.</p>

         <h3>Join Us on the Journey</h3>

         <p>Whether you're a seasoned bibliophile or just beginning your literary voyage, InkFeather invites you to join us on this enchanting journey through 
            the written word. As you peruse our virtual shelves, may you find stories that captivate, characters that linger, and a world of imagination that
            knows no bounds.<br><br>Thank you for choosing InkFeather. Happy reading!</p>
         <a href="contact.php" class="btn">contact us</a>
      </div>

   </div>
</section>
<?php include 'footer.php'; ?>
<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>
