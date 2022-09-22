$(document).ready(function () {
    $("#save-education-btn").click(function (event) {
        $(".form-group").removeClass("has-error");
        $(".help-block").remove();

        var formData = {
            sch_name: $("#sch-name").val(),
            sch_country: $("#sch-country").val(),
            sch_region: $("#sch-region").val(),
            sch_city: $("#sch-city").val(),

            cert_type: $("#cert-type").val(),
            index_number: $("#index-number").val(),
            month_started: $("#month-started").val(),
            year_started: $("#year-started").val(),
            month_completed: $("#month-completed").val(),
            year_completed: $("#year-completed").val(),

            course_studied: $("#course-studied").val(),

            core_sbj1: $("#core-sbj1").val(),
            core_sbj2: $("#core-sbj2").val(),
            core_sbj3: $("#core-sbj3").val(),
            core_sbj4: $("#core-sbj4").val(),
            core_sbj_grd1: $("#core-sbj-grd1").val(),
            core_sbj_grd2: $("#core-sbj-grd2").val(),
            core_sbj_grd3: $("#core-sbj-grd3").val(),
            core_sbj_grd4: $("#core-sbj-grd4").val(),

            elective_sbj1: $("#elective-sbj1").val(),
            elective_sbj2: $("#elective-sbj2").val(),
            elective_sbj3: $("#elective-sbj3").val(),
            elective_sbj4: $("#elective-sbj4").val(),
            elective_sbj_grd1: $("#elective-sbj-grd1").val(),
            elective_sbj_grd2: $("#elective-sbj-grd2").val(),
            elective_sbj_grd3: $("#elective-sbj-grd3").val(),
            elective_sbj_grd4: $("#elective-sbj-grd4").val(),
        };
        
        $.ajax({
            type: "POST",
            url: "../../api/addEducation",
            data: formData,
            dataType: "json",
            encode: true,
        }).done(function (data) {
            console.log(data);

            if (!data.success) {
                if (data.errors.sch_name) {
                    $("#sch-name").addClass("has-error");
                    $("#sch-name").append(
                    '<div class="help-block">' + data.errors.name + "</div>"
                    );
                }

                if (data.errors.email) {
                    $("#email-group").addClass("has-error");
                    $("#email-group").append(
                    '<div class="help-block">' + data.errors.email + "</div>"
                    );
                }

                if (data.errors.superheroAlias) {
                    $("#superhero-group").addClass("has-error");
                    $("#superhero-group").append(
                    '<div class="help-block">' + data.errors.superheroAlias + "</div>"
                    );
                }

            } else {
                $("#education-list").append(
                    '<div class="alert alert-success">' + formData.sch_name + "</div>"
                );
            }
        }).fail(function () {
            $("education-form").html('<div class="alert alert-danger">Could not reach server, please try again later.</div>');
        });

        event.preventDefault();
    });
  });
