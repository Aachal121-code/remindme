<?php
if (!empty($_SESSION['error'])) {
    echo '<div class="toast error">'.$_SESSION['error'].'</div>';
    unset($_SESSION['error']);
}

if (!empty($_SESSION['success'])) {
    echo '<div class="toast success">'.$_SESSION['success'].'</div>';
    unset($_SESSION['success']);
}
?>
<style>
    .toast {
    position: fixed;
    top: 20px;
    right: 20px;
    min-width: 280px;
    max-width: 360px;
    padding: 14px 18px;
    border-radius: 10px;
    font-size: 15px;
    font-weight: 500;
    color: #fff;
    z-index: 9999;
    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    animation: slideIn 0.4s ease, fadeOut 0.5s ease 2.5s forwards;
}

/* Success */
.toast.success {
    background: linear-gradient(135deg, #2ecc71, #27ae60);
}

/* Error */
.toast.error {
    background: linear-gradient(135deg, #e74c3c, #c0392b);
}
</style>