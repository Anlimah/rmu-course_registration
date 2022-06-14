<script src="../js/jquery-3.6.0.min.js"></script>
<!--<script>
    function save(whatNext, to) {
        alert(1);
        $.ajax({
            type: "POST",
            url: to,
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(result) {
                console.log(result);
                let res = JSON.parse(result);
                if (res["response"] == "success") {
                    if (whatNext > 0)
                        window.location.href = 'application-step' + (whatNext += 1) + '.php';
                    else
                        window.location.href = '?logout=true';
                }
            },
            error: function(error) {}
        });
    }
</script>-->