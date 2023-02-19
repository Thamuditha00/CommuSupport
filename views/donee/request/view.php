<link rel="stylesheet" href="../public/CSS/button/button-styles.css">
<?php
/** @var $model \app\models\requestModel */
/** @var $user  \app\models\doneeModel*/

use app\core\Application;

$user = $user->findOne(['doneeID' => Application::$app->session->get('user')]);
$requests = $model->retrieve(["postedBy" => $user->doneeID]);

?>


<!--profile div-->
<div class="profile">
    <div class="notif-box">
        <i class="material-icons">notifications</i>
    </div>
    <div class="profile-box">
        <div class="name-box">
            <h4>Username</h4>
            <p>Position</p>
        </div>
        <div class="profile-img">
            <img src="https://www.w3schools.com/howto/img_avatar.png" alt="profile">
        </div>
    </div>
</div>

<!--   Heading Block - Other Pages for Ongoing, Completed .etc      -->
<?php
$headerDiv = new \app\core\components\layout\headerDiv();

$headerDiv->heading("Your Requests");

$headerDiv->pages(["active", "completed"]);

$headerDiv->end();
?>


<!--        Search and filter boxes -->
<?php
$searchDiv = new \app\core\components\layout\searchDiv();

$searchDiv->filterDivStart();

$searchDiv->filterBegin();

$searchDiv->filterEnd();

$searchDiv->sortBegin();

$searchDiv->sortEnd();

$searchDiv->filterDivEnd();

$creatEvent = \app\core\components\form\form::begin('./request/create', 'get');

echo "<button class='btn-cta-primary'> Request </button>";

$creatEvent->end();

$searchDiv->end();
?>


<div class="content">

    <?php
        echo "<pre>";
        print_r($requests);
        echo "</pre>";
    ?>


</div>