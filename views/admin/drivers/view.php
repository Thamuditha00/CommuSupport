<link rel="stylesheet" href="/CommuSupport/public/CSS/table/table-styles.css">
<?php
use app\core\components\tables\table;

/** @var $model \app\models\driverModel */
/** @var $user \app\models\adminModel */

?>
        <!--        Profile Details-->
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
        <div class="heading-pages">
            <div class="heading">
                <h1>Drivers</h1>
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
           $driver = $model->retrieve();

           $header = ["Name", "Age", "NIC", "Gender", "Address", "ContactNumber","LicenseNo","VehicleNo"];

           $arrayKey = ["name", "age", "NIC", "gender", "address", "contactNumber","licenseNo","vehicleNo"];

           $driverTable = new table($header, $arrayKey);

           $driverTable->displayTable($driver);

?>
        </div>

    


