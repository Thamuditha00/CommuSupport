<?php

namespace app\core\components\layout;

class verificationDiv
{
    public string $userType = '';
    public $user;
    public int $mobileVerification = 0;
    public int $doneeVerification = 0;
    public int $needVerification = 0;

    public function __construct()
    {
        $this->userType = \app\core\Application::session()->get('userType');
        if($this->userType === 'donee') {
            $this->user = \app\models\doneeModel::getModel(['doneeID' => \app\core\Application::session()->get('user')]);
        }
        else if($this->userType === 'donor') {
            $this->user = \app\models\donorModel::getModel(['donorID' => \app\core\Application::session()->get('user')]);
        }
        $this->checkMobileVerification();
        if($this->userType === 'donee') {
            $this->checkDoneeVerification();
        }
    }

    public function checkMobileVerification(): void
    {
        if($this->user->mobileVerification === 0){
            $this->mobileVerification = 1;
            $this->needVerification = 1;
        }
    }

    private function mobileVerificationDiv(): void
    {
        echo "<div class='...'>";
        echo "<div class='...'>";
        echo "<p>You haven't verify your mobile yet. Please verify your mobile to access services </p>";
        echo "</div>";
        echo "<div class='mobile-verification-div-content-body'>";
        echo "<a href='/CommuSupport/verifyMobile' class='btn btn-primary'>Proceed</a>";
        echo "</div>";
        echo "</div>";
    }

    public function checkDoneeVerification(): void
    {
        if($this->user->verificationStatus === 0) {
            $this->doneeVerification = 1;
            $this->needVerification = 1;
        }
    }

    private function doneeVerificationDiv(): void
    {
        echo "<div class='...'>";
        echo "<div class='...'>";
        echo "<p>Your request for registration hasn't been approved yet. </p>";
        echo "</div>";
        echo "</div>";
    }

    public function notVerified(): int
    {
        if($this->needVerification) {
            echo '<div class="content">';
            if($this->mobileVerification) {
                $this->mobileVerificationDiv();
            }
            if($this->doneeVerification) {
                $this->doneeVerificationDiv();
            }
            echo '</div>';
            return 1;
        }
        return 0;
    }

}