<?php 
    require 'layout/header.php';
    require 'lib/functions.php';
    require 'layout/navbar.php';
?>

<?php 
    $pets = getPets(3);

    $cleverWelcomeMessage = "All the love, none of the crap!";
    $pupCount = count($pets);

    // file_put_contents('data/doglife.txt', 'Dogs rule!', FILE_APPEND);
?>

<body>
    <div class="jumbotron"> 
        <div class="container">
            <h1><?php echo ucwords($cleverWelcomeMessage); ?></h1>
            <p>With over <?php echo $pupCount ?> pet friends!</p>
        </div>
    </div>


    <div class="container">
        <div class="row">
            <?php foreach ($pets as $cutePet) { ?>
                
                <div class="col-lg-4 pet-list-item">
                    <h2>
                        <a href="show.php?id=<?php echo $cutePet['id'] ?>">
                            <?php echo $cutePet['name']; ?>
                        </a>
                    </h2>   

                    <img src="images/<?php echo $cutePet['image']; ?>" class="img-rounded" height="120px">

                    <blockquote class="pet-details">
                        <span class="label label-info"><?php echo $cutePet['breed']; ?></span>
                        <?php
                        if (!array_key_exists('age', $cutePet) || $cutePet['age'] == "") {
                            echo "Unknown";
                        } elseif ($cutePet["age"] == "hidden") {
                            echo "(contact owner for age)";
                        } else {
                            echo $cutePet['age'];
                        }
                        ?>
                        <?php echo $cutePet['weight']; ?> lbs                     
                    </blockquote>

                    <p>
                        <?php echo $cutePet['bio']; ?>
                    </p>
                </div>
            <?php } ?>
        </div>
    </div>

</body>

<?php 
    require 'layout/footer.php';
?>

