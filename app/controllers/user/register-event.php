<?php
require_once '../../config/config.php';
require_once '../../../koneksi/koneksi.php';

$id = $_GET['id'] ?? 1;

$events = [
  1 => [
    'title' => 'Tech Future Summit 2026',
    'type' => 'Seminar',
    'price' => 'Gratis',
    'date' => '18 Mei 2026',
    'location' => 'Swiss-Belhotel Lampung',
    'image' => BASEURL . '/assets/images/image.png',
  ],

  2 => [
    'title' => 'Digital Marketing for Beginner',
    'type' => 'Seminar',
    'price' => 'Gratis',
    'date' => '12 Mei 2026',
    'location' => 'Bandar Lampung',
    'image' => BASEURL . '/assets/images/image.png',
  ],

  3 => [
    'title' => 'Coastal Cleanup Movement',
    'type' => 'Volunteer',
    'price' => 'Gratis',
    'date' => '15 Mei 2026',
    'location' => 'Pantai Mutun',
    'image' => BASEURL . '/assets/images/volunteer.jpeg',
  ],

  4 => [
    'title' => 'AI For Student Career',
    'type' => 'Webinar',
    'price' => 'Rp25.000',
    'date' => '21 Mei 2026',
    'location' => 'Zoom Meeting',
    'image' => BASEURL . '/assets/images/image.png',
  ],
];

$event = $events[$id] ?? $events[1];
$isPaid = $event['price'] !== 'Gratis';
$pageTitle = "Pendaftaran Event | Eventify";

require_once '../../views/user/register-event.php';
?>