<?php
if($_SESSION['loggedin']!=true){
    require __DIR__.'/../index.php'; 
    exit;}
$_SESSION['clientData'] = $clientData;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/phpmotors/css/style.css" type="text/css" rel="stylesheet" media="screen">
    <title><?php // Build the Reviews option list
        $reviewifList = '<select name="reviewId" id="reviewId">';
        $reviewifList .= "<option>Choose a Review to Edit or Delete</option>";
            foreach ($reviews as $review) {
            $reviewifList .= "<option value='$review[reviewId]'";
            if(isset($reviewId)){
            if($review['reviewId'] === $reviewId){
            $reviewifList .= ' selected ';}
            } elseif(isset($invId['reviewId'])){
            if($reviews['reviewId'] === $invId['reviewId']){
            $reviewifList .= ' selected ';}
            }
        $reviewifList .= ">$review[reviewInfo]</option>";}
        $reviewifList .= '</select>';?>    
    Reviews View | PHP Motors</title>
</head>

<body>
    <div class="flexC">
        <div id="wrapper">
            <header>
                <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/header.php'; ?>
            </header>

            <nav>
                <?php echo $navList; ?>
            </nav>

            <main>
            <?php
                if (isset($message)) {
                echo $message;
                }
                ?>
            <h1><?php if(isset($reviewInfo['reviewId']) && isset($reviewInfo['clientId']) && isset($reviewInfo['invId'])){ 
	            echo "Modify $reviewInfo[reviewText]";}?></h1>
            </main>
            <form action="/phpmotors/reviews/index.php" method="post">

                <h1>Modify Review</h1>

                <label>Review Date
                        <?php if(isset($reviewDate)){echo "value='$reviewDate'";} elseif(isset($reviewInfo['reviewDate'])) {echo "value='$reviewInfo[reviewDate]'"; }?>
                       </label><br>
                <label>First Name
                    <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";}elseif(isset($reviwInfo['clientFirstName'])) {echo "value='$reviewInfo[clientFirstName]'";}?></label><br>
                <label>Last Name
                        <?php if(isset($clientLastName)){echo "value='$clientLastName'";} elseif(isset($reviwInfo['clientLastName'])) {echo "value='$reviewInfo[clientLastName]'";}?></label><br>
                <label>Vehicle Make & Model
                        <?php if(isset($invMake)){ echo $invMake; } elseif(isset($reviwInfo['invMake'])) {echo "value='$reviewInfo[invMake]'";}?>
                        <?php if(isset($invModel)){echo $invModel;} elseif(isset($reviewInfo['invModel'])) {echo "value='$reviewInfo[invModel]'";}?>
                    </label><br>
                <label>Vehicle Review
                    <input type="text" name="reviewText" 
                        <?php if(isset($reviewText)){echo "value='$reviewText'";} elseif(isset($reviewInfo['reviewText'])) {echo "value='$reviewInfo[reviewText]'"; }?>
                        required></label><br>

                <input type="hidden" name="action" value="updateReview">
                <input type="hidden" name="reviewId" value="
                <?php if(isset($reviewInfo['reviewId'])){ echo $reviewInfo['reviewId'];} 
                elseif(isset($reviewId)){ echo $reviewId; } ?>">

                <button type="submit" name="submit" value="Update Review">Update</button>
                
                <input type="submit" class="regbtn" name="submit" value="Delete Review">
                <input type="hidden" name="action" value="deleteReview">
                <input type="hidden" name="reviewId" value="<?php if(isset($reviewInfo['reviewId'])){
                 echo $reviewInfo['reviewid'];} ?>">
                </form>
                <p>Confirm Review Deletion. The delete is permanent.</p>
            <hr>
            <footer>
                <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>
            </footer>
        </div>
        <!-Wrapper ends->
    </div>
</body>

</html>