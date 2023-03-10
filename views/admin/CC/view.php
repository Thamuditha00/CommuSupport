<link rel="stylesheet" href="/CommuSupport/public/CSS/button/button-styles.css">
<link rel="stylesheet" href="/CommuSupport/public/CSS/table/table-styles.css">



<?php
use app\core\components\tables\table;

/** @var $model \app\models\ccModel */
/** @var $user \app\models\adminModel */

?>

<?php $profile = new \app\core\components\layout\profileDiv();

$profile->notification();

$profile->profile();

$profile->end(); ?>

        <!--   Heading Block - Other Pages for Ongoing, Completed .etc      -->
        <div class="heading-pages">
            <div class="heading">
                <h1>Community Centers</h1>
            </div>
        </div>

        <!--        Search and filter boxes -->
        <div class="search-filter">

            <div class="filters">
                <div class="filter">
                    <p><i class="material-icons">filter_list</i><span>Filter</span></p>
                </div>
                <div class="sort">
                    <p><i class="material-icons">sort</i> <span>Sort</span></p>
                </div>
            </div>
            <div class="search">
                <input type="text" placeholder="Search">
                <a href="#"><i class="material-icons">search</i></a>
            </div>

        </div>

        <!--        Content Block-->
        <div class="content">
<?php
            $userID = \app\core\Application::session()->get('user');
           // $user = $user->findOne(['adminId' => $userID]);
           $CC = $model->retrieve();

           $header = ["Address", "City", "Email", "Fax", "Contact Number", "CommunityHeadOfficers"];

           $arrayKey = ["address", "city", "email", "fax", "contactNumber", "cho"];

           $ccTable = new table($header, $arrayKey);

           $ccTable->displayTable($CC);

?>

        </div>

    


