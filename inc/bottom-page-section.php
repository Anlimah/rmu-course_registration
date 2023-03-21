<div class="page-control" style="margin-top:20px !important; display: flex; flex-direction: <?= $page["id"] == 0 ? "row-reverse" : "row" ?>; justify-content: space-between;">
    <?php if ($page["id"] >= 5) { ?>
        <a id="download" style="width: 50%; margin-right: 10px" href="<?= "application-step" . ($page["id"] - 1) . ".php" ?>" id="prevPage" class="btn btn-secondary text-white <?= $page["id"] == 0 ? "yes-disability" : "" ?>">Download a copy</a>
        <button id="complete" type="submit" class="btn btn-danger btn-xxlarge text-white" style="width: 400px; font-weight:700; margin-right: 10px">Complete Application</button>
    <?php } else { ?>
        <a style="width: 50%; margin-right: 10px" href="?logout=true" id="prevPage" class="btn btn-secondary text-white <?= $page["id"] == 0 ? "yes-disability" : "" ?>">Save and Exit</a>
        <button type="submit" id="submitBtn" style="width: 50%; margin-left: 10px" class="btn btn-primary text-white">Check My Work and Continue</button>
    <?php } ?>
</div>
<div style="width:100%; text-align:center">Your progress is automatically saved!</div>