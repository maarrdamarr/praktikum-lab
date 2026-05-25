<?php
$dir = 'c:/laragon/www/praktikum-lab/resources/views';
$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));

$replacements = [
    'Laboratorium Kimia Dasar' => 'Laboratorium Komputer Terpadu',
    'Lab Kimia Dasar' => 'Lab Komputer Dasar',
    'Lab Kimia' => 'Lab Komputer A',
    'Kimia Dasar I' => 'Pemrograman Dasar',
    'Kimia Organik 1' => 'Basis Data',
    'Kimia Organik' => 'Basis Data',
    'Kimia' => 'Informatika',
    'Analisis Kuantitatif Senyawa Organik' => 'Implementasi CRUD pada Framework Laravel',
    'Spektroskopi UV-Vis' => 'Pemrograman Web Lanjut',
    'Spektroskopi' => 'Pemrograman Web',
    'Destilasi Bertingkat' => 'Struktur Data',
    'Uji Kualitas Air' => 'Jaringan Komputer',
    'hukum Lambert-Beer dalam spektroskopi' => 'konsep MVC dalam Laravel',
];

foreach ($iterator as $file) {
    if ($file->isFile() && $file->getExtension() === 'php') {
        $path = $file->getPathname();
        $content = file_get_contents($path);
        $newContent = str_replace(array_keys($replacements), array_values($replacements), $content);
        if ($content !== $newContent) {
            file_put_contents($path, $newContent);
            echo "Updated: $path\n";
        }
    }
}
