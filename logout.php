<?php session_start();
    session_destroy();
    echo "<script>alert('ออกจากระบบเรียบร้อยแล้ว');</script>";
    echo "<script>window.location.href='index.php';</script>";
?>