<?php
require_once '../../config/config.php';
require_once '../../../koneksi/koneksi.php';
require_once '../../models/EventModel.php';

$pageTitle = "Jelajahi Event | Eventify";

$events = getAllEvent($conn);

require_once '../../views/user/dashboard.php';