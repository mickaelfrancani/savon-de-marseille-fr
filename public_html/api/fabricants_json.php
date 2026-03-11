<?php
/**
 * API endpoint: /api/fabricants.json
 * Retourne le GeoJSON des fabricants pour Leaflet.js
 */

header('Content-Type: application/json; charset=UTF-8');
header('Access-Control-Allow-Origin: *');

$db = getDB();

$stmt = $db->prepare(
    'SELECT id, nom, slug, ville, departement, latitude, longitude, certifications
     FROM fabricants
     WHERE actif = 1 AND latitude IS NOT NULL AND longitude IS NOT NULL
     ORDER BY nom ASC'
);
$stmt->execute();
$fabricants = $stmt->fetchAll();

$features = [];
foreach ($fabricants as $f) {
    $features[] = [
        'type' => 'Feature',
        'geometry' => [
            'type' => 'Point',
            'coordinates' => [(float)$f['longitude'], (float)$f['latitude']]
        ],
        'properties' => [
            'id' => $f['id'],
            'nom' => $f['nom'],
            'slug' => $f['slug'],
            'ville' => $f['ville'],
            'departement' => $f['departement'],
            'certifications' => $f['certifications']
        ]
    ];
}

$geojson = [
    'type' => 'FeatureCollection',
    'features' => $features
];

echo json_encode($geojson, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
