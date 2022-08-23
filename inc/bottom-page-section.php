<center>
    <div class="page-control" style="display: flex; flex-direction: <?= $page["id"] == 0 ? "row-reverse" : "row" ?>; justify-content: space-between; padding: 0 120px">
        <a href="<?= "application-step" . ($page["id"] - 1) . ".php" ?>" id="prevPage" class="m-3 btn btn-secondary text-white <?= $page["id"] == 0 ? "yes-disability" : "" ?>">Back -> Use of Information</a>
        <!--<button type="button" id="saveAndExit" onclick="whatNext(1)" class="m-3 btn btn-default">Save and Exit</button>-->
        <a href="<?= "application-step" . ($page["id"] + 1) . ".php" ?>" id="nextPage" class="m-3 btn btn-primary text-white">Next -> Academic Background</a>
    </div>
</center>