$(document).ready(function () {

    let end = 3;
    let next = 1;

    $("#nextStep").click(function() {
        if (next)
            if (next >= 1 && next < end) {
                next = next + 1;
                $(".steps").addClass("hide");
                $(".steps").removeClass("display");
                $("#step-" + next).removeClass("hide");
                $("#step-" + next).addClass("display");
                $("#prevStep").removeClass("hide");
                $("#prevStep").addClass("display");
                $(this).blur();
                if (next == end) {
                    $(this).hide();
                    $("#save-education-btn").removeClass("hide");
                    $("#save-education-btn").addClass("display");
                    $(this).addClass("hide");
                    $(this).removeClass("display");
                }
            }
    });

    $("#prevStep").click(function() {
        if (next > 1 && next <= end) {
            next = next - 1;
            $(".steps").addClass("hide");
            $(".steps").removeClass("display");
            $("#step-" + next).removeClass("hide");
            $("#step-" + next).addClass("display");
            $("#nextStep").removeClass("hide");
            $("#nextStep").addClass("display");
            $("#save-education-btn").addClass("hide");
            $("#save-education-btn").removeClass("display");
            $("#nextStep").show();
            $(this).blur();
            if (next == 1) {
                $("#prevStep").removeClass("display");
                $("#prevStep").addClass("hide");
            }
        }
    });

    $("#add-education-btn").click(function() {
        $(".mb-4").removeClass("has-error");
        $(".help-block").remove();
    });

    //Edit button on each added education item
    $(".edit-edu-btn").click(function(e) {
        $("#addSchoolModal").modal("toggle");
        /*$.ajax({
            type: "GET",
            url: "../../api/education",
            data: {
                what: this.name,
                value: this.id,
            },
            dataType: "json",
            encode: true,
        }).done(function (data) {
            console.log(data);
            
            if (!data.success) {

            }
            if (data.success) {

            }
        }).fail(function () {
            alert("Could not reach server, please try again later.")
        });*/

        e.preventDefault();
    });

    $("#save-education-btn").click(function (event) {
        // Prepare data payload for submission
        $(".mb-4").removeClass("has-error");
        $(".mb-2").removeClass("has-error");
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
        
        // Sent payload to server
        $.ajax({
            type: "POST",
            url: "../../api/addEducation",
            data: formData,
            dataType: "json",
            encode: true,
        }).done(function (data) {
            console.log(data);
            let step_errors = 0;
            if (!data.success) {
                let step1, step2, step3, step4 = 0;

                //Step 1
                if (data.errors.sch_name) {
                    $("#sch-name-group").addClass("has-error");
                    $("#sch-name-group").append('<div class="help-block">' + data.errors.sch_name + "</div>");
                    step1 = 1;
                }
                if (data.errors.sch_country) {
                    $("#sch-country-group").addClass("has-error");
                    $("#sch-country-group").append('<div class="help-block">' + data.errors.sch_country + "</div>");
                    step1 = 1;
                }
                if (data.errors.sch_region) {
                    $("#sch-region-group").addClass("has-error");
                    $("#sch-region-group").append('<div class="help-block">' + data.errors.sch_region + "</div>");
                    step1 = 1;
                }
                if (data.errors.sch_city) {
                    $("#sch-city-group").addClass("has-error");
                    $("#sch-city-group").append('<div class="help-block">' + data.errors.sch_city + "</div>");
                    step1 = 1;
                }

                //Step 2
                if (data.errors.cert_type) {
                    $("#cert-type-group").addClass("has-error");
                    $("#cert-type-group").append('<div class="help-block">' + data.errors.cert_type + "</div>");
                    step2 = 2;
                }
                if (data.errors.index_number) {
                    $("#index-number-group").addClass("has-error");
                    $("#index-number-group").append('<div class="help-block">' + data.errors.index_number + "</div>");
                    step2 = 2;
                }
                if (data.errors.date_started) {
                    $("#date-started-group").addClass("has-error");
                    $("#date-started-group").append('<div class="help-block">' + data.errors.date_started + "</div>");
                    step2 = 2;
                }
                if (data.errors.date_completed) {
                    $("#date-completed-group").addClass("has-error");
                    $("#date-completed-group").append('<div class="help-block">' + data.errors.date_completed + "</div>");
                    step2 = 2;
                }

                //Step 3
                if (data.errors.course_studied) {
                    $("#course-studied-group").addClass("has-error");
                    $("#course-studied-group").append('<div class="help-block">' + data.errors.course_studied + "</div>");
                    step3 = 3;
                }
                // core
                if (data.errors.core_sbj_grp1) {
                    $("#core-sbj1-group").addClass("has-error");
                    $("#core-sbj1-group").append('<div class="help-block">' + data.errors.core_sbj_grp1 + "</div>");
                    step3 = 3;
                }
                if (data.errors.core_sbj_grp2) {
                    $("#core-sbj2-group").addClass("has-error");
                    $("#core-sbj2-group").append('<div class="help-block">' + data.errors.core_sbj_grp2 + "</div>");
                    step3 = 3;
                }
                if (data.errors.core_sbj_grp3) {
                    $("#core-sbj3-group").addClass("has-error");
                    $("#core-sbj3-group").append('<div class="help-block">' + data.errors.core_sbj_grp3 + "</div>");
                    step3 = 3;
                }
                if (data.errors.core_sbj_grp4) {
                    $("#core-sbj4-group").addClass("has-error");
                    $("#core-sbj4-group").append('<div class="help-block">' + data.errors.core_sbj_grp4 + "</div>");
                    step3 = 3;
                }
                //elective
                if (data.errors.elective_sbj_grp1) {
                    $("#elective-sbj1-group").addClass("has-error");
                    $("#elective-sbj1-group").append('<div class="help-block">' + data.errors.elective_sbj_grp1 + "</div>");
                    step3 = 3;
                }
                if (data.errors.elective_sbj_grp2) {
                    $("#elective-sbj2-group").addClass("has-error");
                    $("#elective-sbj2-group").append('<div class="help-block">' + data.errors.elective_sbj_grp2 + "</div>");
                    step3 = 3;
                }
                if (data.errors.elective_sbj_grp3) {
                    $("#elective-sbj3-group").addClass("has-error");
                    $("#elective-sbj3-group").append('<div class="help-block">' + data.errors.elective_sbj_grp3 + "</div>");
                    step3 = 3;
                }
                if (data.errors.elective_sbj_grp4) {
                    $("#elective-sbj4-group").addClass("has-error");
                    $("#elective-sbj4-group").append('<div class="help-block">' + data.errors.elective_sbj_grp4 + "</div>");
                    step3 = 3;
                }

                if (step1) {
                    step_errors = step1;
                } else if (step2) {
                    step_errors = step2;
                } else if (step3) {
                    step_errors = step3;
                } else if (step4) {
                    step_errors = step4;
                }

                //Steps redirection
                if (step_errors) {
                    alert(step_errors);
                    $(".steps").addClass("hide");
                    $(".steps").removeClass("display");
                    $("#step-" + step_errors).removeClass("hide");
                    $("#step-" + step_errors).addClass("display");
                    
                    if (step_errors == 1) {
                        $("#prevStep").removeClass("display");
                        $("#prevStep").addClass("hide");    
                        $("#nextStep").removeClass("hide");
                        $("#nextStep").addClass("display");
                        $("#save-education-btn").removeClass("display");
                        $("#save-education-btn").addClass("hide");
                    } else if (step_errors == 3) {
                        $("#prevStep").removeClass("hide");
                        $("#prevStep").addClass("display");    
                        $("#nextStep").removeClass("display");
                        $("#nextStep").addClass("hide");
                        $("#save-education-btn").removeClass("display");
                        $("#save-education-btn").addClass("hide");
                    } else if(step_errors > 1 && step_errors < 3) {
                        $("#prevStep").removeClass("hide");
                        $("#prevStep").addClass("display");    
                        $("#nextStep").removeClass("hide");
                        $("#nextStep").addClass("display");
                        $("#save-education-btn").removeClass("display");
                        $("#save-education-btn").addClass("hide");
                    }
                    //next = step_errors;
                }

            } else {
                let school = formData.sch_name.toLowerCase().replace(/\b[a-z]/g, function(letter) {
                    return letter.toUpperCase();
                });
                let period = formData.month_started + ' ' + formData.year_started + ' - ' + formData.month_completed + ' ' + formData.year_completed;
                $("#education-list").append(
                    '<div class="mb-4 edu-history">' +
                        '<div class="edu-history-header">' +
                            '<div class="edu-history-header-info">' +
                                '<p style="font-size: 17px; font-weight: 600;margin:0;padding:0">' + school +'</p>'+
                                '<p style="font-size: 16px; font-weight: 500; color:#8c8c8c;margin:0;padding:0">' + period + '</p>'+
                            '</div>' +
                            '<div class="edu-history-control">' +
                                '<button type="button" class="btn edit-edu-btn" id="'+ formData.edu_id +'" data-bs-toggle="modal" data-bs-target="#addSchool">' +
                                    '<span class="bi bi-pencil-fill" style="font-size: 20px !important;"></span>'+
                                '</button>' +
                                '<button type="button" class="btn delete-edu-btn" id="'+ formData.edu_id +'">' +
                                    '<span class="bi bi-trash-fill" style="font-size: 20px !important;"></span>' +
                                '</button>' +
                            '</div>' +
                        '</div>' +
                        '<!--<div class="edu-history-footer">' +
                            '<a>Upload a scan copy of Certificate</a>' +
                        '</div>-->' +
                    '</div>'
                );
                $("#addSchoolModal").modal("toggle");
            }
        }).fail(function () {
            $("education-form").html('<div class="alert alert-danger">Could not reach server, please try again later.</div>');
        });

        event.preventDefault();
    });
  });
