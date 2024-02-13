<?php
/*
Plugin Name: Radio Player
Description: Plugin untuk memutar radio online.
Version: 1.0
Author: Tecnixindo - Muhammad Fauzan Sholihin

Usage: [radio_player url="https://your-custom-url"]
*/

// Tambahkan shortcode untuk memasukkan pemutar radio
function radio_player_shortcode($atts) {
    // Ambil URL streaming dari atribut shortcode atau gunakan default jika tidak disediakan
    $url = isset($atts['url']) ? esc_url($atts['url']) : 'https://radio.example.com:8000/live';

    // Output tag audio
    $output = '<audio controls>';
    $output .= '<source src="' . $url . '" type="audio/mpeg">';
    $output .= 'Your browser does not support the audio element.';
    $output .= '</audio>';

    // Ambil metadata dari streaming audio dan tampilkan di bawah pemutar
    // Gantilah bagian ini sesuai dengan format metadata audio streaming yang digunakan

    // Contoh menggunakan Icecast
    $metadata_url = $url . '/status-json.xsl';
    $metadata_json = file_get_contents($metadata_url);
    $metadata = json_decode($metadata_json, true);

    if ($metadata && isset($metadata['icestats']['source'])) {
        $current_song = $metadata['icestats']['source']['title'];
        $output .= '<p>' . esc_html($current_song) . '</p>';
    }

    return $output;
}
add_shortcode('radio_player', 'radio_player_shortcode');
?>