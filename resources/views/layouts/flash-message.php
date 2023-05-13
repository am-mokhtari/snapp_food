<?php
$hasSession = false;
if (Session::has('success')) {
    $colors = 'bg-lime-200 text-lime-600';
    $message = Session::get('success');
    $hasSession = true;
} elseif (Session::has('warning')) {
    $colors = 'bg-yellow-200 text-yellow-700';
    $message = Session::get('warning');
    $hasSession = true;
} elseif (Session::has('danger')) {
    $colors = 'bg-red-200 text-red-700';
    $message = Session::get('danger');
    $hasSession = true;
} elseif (Session::has('message')) {
    $colors = 'bg-teal-100 text-teal-600';
    $message = Session::get('message');
    $hasSession = true;
}

if ($hasSession) { ?>
    <div class="p-2 m-2 <?= $colors ?> border rounded">
        <h2 class="h2"><?= $message ?></h2>
    </div>
<?php } ?>
