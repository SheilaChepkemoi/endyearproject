<?php
session_start();

if(isset($_SESSION['email'])){
    print_r("logged in");
}else{
    print_r("logged out");
}