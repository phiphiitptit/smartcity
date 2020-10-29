<?php
$_SESSION['booking_state']='ready';
echo'
<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
<div class="sidebar-sticky pt-3">
    <ul class="nav flex-column">
        <li class="nav-item">
        <a class="nav-link active" href="user_booking.php">
            <span class="iconify" data-icon="bi:clock-history" data-inline="false"></span>
            Đặt xe <span class="sr-only">(current)</span>
        </a>
        </li>
        <li class="nav-item">
        <a class="nav-link active" href="user_pending.php">
            <span class="iconify" data-icon="bi-arrow-up-right-square" data-inline="false"></span>
            Đang thực hiện <span class="sr-only">(current)</span>
        </a>
        </li>
        <li class="nav-item">
        <a class="nav-link active" href="user_fee.php">
            <span class="iconify" data-icon="bi-basket2-fill" data-inline="false"></span>
            Bảng giá <span class="sr-only">(current)</span>
        </a>
        </li>
        <li class="nav-item">
        <a class="nav-link active" href="user_history.php">
            <span class="iconify" data-icon="bi-chat-dots" data-inline="false"></span>
            Lịch sử <span class="sr-only">(current)</span>
        </a>
        </li>
        </li>
    </ul>
</div>
</nav>';
?>