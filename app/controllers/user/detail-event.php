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
    'time' => '09:00 WIB',
    'location' => 'Swiss-Belhotel Lampung',
    'desc' => 'Seminar teknologi terbesar di Bandar Lampung yang membahas Artificial Intelligence, Cyber Security, Data Science, dan Future Digital Industry.',
    'image' => 'https://images.unsplash.com/photo-1511578314322-379afb476865?q=80&w=1400&auto=format&fit=crop',
    'organizer' => 'Tech Community Lampung',
    'logo' => 'T'
  ],

  2 => [
    'title' => 'Digital Marketing for Beginner',
    'type' => 'Seminar',
    'price' => 'Gratis',
    'date' => '12 Mei 2026',
    'time' => '13:00 WIB',
    'location' => 'Bandar Lampung',
    'desc' => 'Belajar strategi digital marketing dari dasar, mulai dari branding, social media marketing, hingga ads campaign untuk pemula.',
    'image' => 'https://images.unsplash.com/photo-1552664730-d307ca884978?q=80&w=1400&auto=format&fit=crop',
    'organizer' => 'Himakom Unila',
    'logo' => 'H'
  ],

  3 => [
    'title' => 'Coastal Cleanup Movement',
    'type' => 'Volunteer',
    'price' => 'Gratis',
    'date' => '15 Mei 2026',
    'time' => '07:00 WIB',
    'location' => 'Pantai Mutun',
    'desc' => 'Kegiatan volunteer peduli lingkungan untuk membersihkan area pesisir bersama komunitas pecinta alam Lampung.',
    'image' => 'https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?q=80&w=1400&auto=format&fit=crop',
    'organizer' => 'Green Lampung',
    'logo' => 'G'
  ],

  4 => [
    'title' => 'AI For Student Career',
    'type' => 'Webinar',
    'price' => 'Rp25.000',
    'date' => '21 Mei 2026',
    'time' => '19:00 WIB',
    'location' => 'Zoom Meeting',
    'desc' => 'Kupas tuntas bagaimana Artificial Intelligence membuka peluang karir baru untuk mahasiswa di era digital.',
    'image' => 'https://images.unsplash.com/photo-1485827404703-89b55fcc595e?q=80&w=1400&auto=format&fit=crop',
    'organizer' => 'TechTalkID',
    'logo' => 'T'
  ],
];

$event = $events[$id] ?? $events[1];
$pageTitle = $event['title'] . " | Eventify";

require_once '../../views/user/detail-event.php';
?>