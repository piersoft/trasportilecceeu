<?php
/**
 * gtfs_shapes_to_geojson.php
 * Compatibile PHP 5.3+ - basso consumo di memoria (streaming shapes)
 *
 * CLI:  php gtfs_shapes_to_geojson.php [gtfs_dir] [output.geojson]
 * Web:  ?gtfs_dir=/path/to/gtfs&output=/path/to/output.geojson
 */

// Timezone di default - sovrascrivibile da php.ini o dal chiamante
if (!ini_get('date.timezone')) {
    date_default_timezone_set('Europe/Rome');
}

// Aumenta memoria se possibile (utile se chiamato via include/exec)
@ini_set('memory_limit', '512M');

// ---------------------------------------------------------------------------
// 1. Parametri
// ---------------------------------------------------------------------------
if (php_sapi_name() === 'cli') {
    $gtfsDir    = isset($argv[1]) ? $argv[1] : dirname(__FILE__);
    $outputFile = isset($argv[2]) ? $argv[2] : null;
} else {
    $gtfsDir    = isset($_GET['gtfs_dir']) ? $_GET['gtfs_dir'] : dirname(__FILE__);
    $outputFile = isset($_GET['output'])   ? $_GET['output']   : null;
    if (!$outputFile) {
        header('Content-Type: application/json; charset=utf-8');
        header('Content-Disposition: attachment; filename="routes_shapes.geojson"');
    }
}

$gtfsDir = rtrim($gtfsDir, '/');

// ---------------------------------------------------------------------------
// 2. Helper: legge CSV con header, ritorna array di array associativi
// ---------------------------------------------------------------------------
function gtfs_read_csv($path)
{
    $fh = fopen($path, 'r');
    if (!$fh) { die("ERRORE: impossibile aprire $path\n"); }

    $header = fgetcsv($fh);
    $header[0] = ltrim($header[0], "\xEF\xBB\xBF");
    foreach ($header as $k => $v) { $header[$k] = trim($v); }

    $rows = array();
    while (($line = fgetcsv($fh)) !== false) {
        if (count($line) < count($header)) { continue; }
        $row = array();
        foreach ($header as $i => $col) { $row[$col] = trim($line[$i]); }
        $rows[] = $row;
    }
    fclose($fh);
    return $rows;
}

// ---------------------------------------------------------------------------
// 3. Carica routes.txt
// ---------------------------------------------------------------------------
$routes = array();
foreach (gtfs_read_csv($gtfsDir . '/routes.txt') as $row) {
    $color     = ltrim(isset($row['route_color'])      ? $row['route_color']      : 'aaaaaa', '#');
    $textColor = ltrim(isset($row['route_text_color']) ? $row['route_text_color'] : '000000', '#');
    if ($color === '')     { $color     = 'aaaaaa'; }
    if ($textColor === '') { $textColor = '000000'; }
    $routes[$row['route_id']] = array(
        'route_short_name' => isset($row['route_short_name']) ? $row['route_short_name'] : $row['route_id'],
        'route_long_name'  => isset($row['route_long_name'])  ? $row['route_long_name']  : '',
        'route_color'      => '#' . strtoupper($color),
        'route_text_color' => '#' . strtoupper($textColor),
        'route_type'       => isset($row['route_type'])       ? $row['route_type']       : '3',
    );
}

// ---------------------------------------------------------------------------
// 4. Carica trips.txt → [shape_id => route_id]
// ---------------------------------------------------------------------------
$shapeToRoute = array();
foreach (gtfs_read_csv($gtfsDir . '/trips.txt') as $row) {
    $sid = isset($row['shape_id']) ? $row['shape_id'] : '';
    if ($sid !== '' && !isset($shapeToRoute[$sid])) {
        $shapeToRoute[$sid] = $row['route_id'];
    }
}

// ---------------------------------------------------------------------------
// 5. Legge shapes.txt in streaming: una shape alla volta in RAM
//
//    Il file GTFS ha le righe GIA' raggruppate per shape_id e ordinate
//    per sequence (spec GTFS). Accumuliamo i punti della shape corrente
//    e non appena cambia shape_id, emettiamo la Feature e svuotiamo.
// ---------------------------------------------------------------------------
$shapePath = $gtfsDir . '/shapes.txt';
$fh = fopen($shapePath, 'r');
if (!$fh) { die("ERRORE: impossibile aprire $shapePath\n"); }

$shapeHeader = fgetcsv($fh);
$shapeHeader[0] = ltrim($shapeHeader[0], "\xEF\xBB\xBF");
foreach ($shapeHeader as $k => $v) { $shapeHeader[$k] = trim($v); }

$idxId  = array_search('shape_id',          $shapeHeader);
$idxLat = array_search('shape_pt_lat',      $shapeHeader);
$idxLon = array_search('shape_pt_lon',      $shapeHeader);
$idxSeq = array_search('shape_pt_sequence', $shapeHeader);

// Funzione che costruisce una singola Feature da shape_id + punti accumulati
function build_feature($shapeId, $seqMap, $shapeToRoute, $routes)
{
    ksort($seqMap);
    $coordinates = array_values($seqMap);

    $routeId   = isset($shapeToRoute[$shapeId]) ? $shapeToRoute[$shapeId] : null;
    $routeInfo = ($routeId && isset($routes[$routeId])) ? $routes[$routeId] : array();

    $color     = isset($routeInfo['route_color'])      ? $routeInfo['route_color']      : '#AAAAAA';
    $textColor = isset($routeInfo['route_text_color']) ? $routeInfo['route_text_color'] : '#000000';

    return array(
        'type'     => 'Feature',
        'geometry' => array(
            'type'        => 'LineString',
            'coordinates' => $coordinates,
        ),
        'properties' => array(
            'shape_id'         => $shapeId,
            'route_id'         => $routeId,
            'route_short_name' => isset($routeInfo['route_short_name']) ? $routeInfo['route_short_name'] : null,
            'route_long_name'  => isset($routeInfo['route_long_name'])  ? $routeInfo['route_long_name']  : null,
            'route_color'      => $color,
            'route_text_color' => $textColor,
            'route_type'       => isset($routeInfo['route_type'])       ? $routeInfo['route_type']       : null,
            'stroke'           => $color,
            'stroke-width'     => 3,
            'stroke-opacity'   => 0.85,
        ),
    );
}

$features       = array();
$currentShapeId = null;
$currentSeqMap  = array();

while (($line = fgetcsv($fh)) !== false) {
    if (count($line) <= max($idxId, $idxLat, $idxLon, $idxSeq)) { continue; }

    $sid = trim($line[$idxId]);
    $seq = (int)trim($line[$idxSeq]);
    $lat = (float)trim($line[$idxLat]);
    $lon = (float)trim($line[$idxLon]);

    if ($currentShapeId === null) {
        $currentShapeId = $sid;
    }

    if ($sid !== $currentShapeId) {
        // Shape completata: costruisci la feature e libera i punti
        $features[] = build_feature($currentShapeId, $currentSeqMap, $shapeToRoute, $routes);
        $currentShapeId = $sid;
        $currentSeqMap  = array();
    }

    $currentSeqMap[$seq] = array($lon, $lat);
}
fclose($fh);

// Ultima shape
if ($currentShapeId !== null && !empty($currentSeqMap)) {
    $features[] = build_feature($currentShapeId, $currentSeqMap, $shapeToRoute, $routes);
}

// ---------------------------------------------------------------------------
// 6. Assembla GeoJSON
// ---------------------------------------------------------------------------
$geojson = array(
    'type'     => 'FeatureCollection',
    'features' => $features,
    'metadata' => array(
        'generated_at' => date('c'),
        'total_shapes' => count($features),
        'total_routes' => count($routes),
        'source'       => 'GTFS shapes.txt + routes.txt + trips.txt',
    ),
);

$jsonFlags = JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES;
if (defined('JSON_PRETTY_PRINT')) { $jsonFlags = $jsonFlags | JSON_PRETTY_PRINT; }
$json = json_encode($geojson, $jsonFlags);

// ---------------------------------------------------------------------------
// 7. Output
// ---------------------------------------------------------------------------
if ($outputFile) {
    $written = file_put_contents($outputFile, $json);
    if ($written === false) {
        $err = "ERRORE: impossibile scrivere su $outputFile";
        if (php_sapi_name() === 'cli') {
            fwrite(STDERR, $err . "\n");
        } else {
            echo json_encode(array('success' => false, 'message' => $err));
        }
        exit(1);
    }
    $kb  = round($written / 1024, 1);
    $msg = "GeoJSON scritto: $outputFile ({$kb} KB, " . count($features) . " shapes)";
    if (php_sapi_name() === 'cli') {
        echo $msg . "\n";
    } else {
        echo json_encode(array('success' => true, 'message' => $msg, 'file' => $outputFile));
    }
} else {
    echo $json;
}
