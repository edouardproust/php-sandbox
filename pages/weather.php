<?php

$title = 'Weather';

// VARIABLES

$locations = [
    'paris_fr'         => [48.85, 2.35],
    'new-york_us'      => [40.71, -74.00],
    'kerikeri_nz'      => [-35.22, 173.94]
];

$alert_class = $error = null;
$api_key = '4f34eb4cec4aa5200aa8b415963e297c';
$timeout = 4500;

if (array_key_exists('httpError', $_POST)) {
    $api_key = 'a';
} elseif (array_key_exists('curlError', $_POST)) {
    $timeout = 5;
} else {
    unset($_POST);
}


// FILES CALLS

require_once '../includes/header.php';
require_once '../class/OpenWeather.php';
require_once '../class/Exceptions/CurlException.php';
require_once '../class/Exceptions/HTTPException.php';

// CLASSES INIT. & EXCEPTIONS DEFINITION

$weather = new OpenWeather($api_key, $timeout);
try {
    foreach ($locations as $location => $coordinates) {
        $locations_current[$location] = $weather->getCurrent($coordinates);
    }
} catch (CurlException $e) {
    $error = '<b>API error info:</b> ' . $e->getMessage() . '.';
    $alert_class = 'danger';
} catch (HTTPException $e) {
    $error = '<b>' . $e->getCode() . ' Error status:</b> ' . $e->getMessage();
    $alert_class = 'primary';
}
if ($error) {
    $error = '<b>Oops, this was not supposed to happen.</b>
        <div class="small mb-2">' . $error . '</div>
        Please try again later or <a href="contact.php">contact us</a>.';
    $error_sub = '<a href="index.php">Go back to homepage</a>';
}

// DISPLAYING PART 
?>

<div class="lead mb-5">
    The forecast below has been achieved with <a href="https://openweathermap.org/forecast5">OpenWeather API</a>.
</div>
<h3 class="mb-3">Our restaurants locations:</h3>
<?php if ($error) : ?>
    <div class="alert <?= $alert_class ? 'alert-' . $alert_class : '' ?>"><?= $error ?></div>
    <div><?= $error_sub ?></div>
<?php else : ?>
    <div class="row">
        <?php foreach ($locations_current as $location => $data) : ?>
            <?php $title = OpenWeather::getName($location) ?>
            <div class="col-md-<?= count($locations) === 4 ? '3' : '4' ?> mb-5">
                <div class="card">
                    <div class="card-body text-center">
                        <h4><?= $title['city'] . ' <span class="small text-muted">(' . $title['country'] . ')</span>' ?></h4>
                        <div class="small text-muted"><?= $data['time']['all'] ?></div>
                        <img src="<?= $data['icon']; ?>" />
                        <div><?= $data['description'] ?></div>
                        <div><b><?= $data['temp'] ?></b></div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif;

// END OF FILE

require '../includes/footer.php'; ?>