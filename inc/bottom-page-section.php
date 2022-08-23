<center>
    <div class="page-control" style="display: flex; flex-direction: <?= $page["id"] == 0 ? "row-reverse" : "row" ?>; justify-content: space-between; padding: 0 120px">
        <a href="<?= "application-step" . ($page["id"] - 1) . ".php" ?>" id="prevPage" class="m-3 btn btn-secondary text-white <?= $page["id"] == 0 ? "yes-disability" : "" ?>">Back >> Use of Information</a>
        <!--<button type="button" id="saveAndExit" onclick="whatNext(1)" class="m-3 btn btn-default">Save and Exit</button>-->
        <?php if ($page["id"] >= 5) { ?>
            <form action="#">
                <button type="submit" class="m-3 btn btn-danger btn-xxlarge text-white" style="width: 320px; font-weight:700">Complete Application</a>
            </form><?php } else { ?>
            <a href="<?= "application-step" . ($page["id"] + 1) . ".php" ?>" class="m-3 btn btn-primary text-white">Next >> Academic Background</a>
        <?php } ?>
    </div>
</center>