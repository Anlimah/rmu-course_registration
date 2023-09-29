$(document).ready(function () {
    // Add education modal form
    let end = 3;
    let add_next = 1;
    let edit_next = 1;

    // When next button is clicked
    $("#nextStep").click(function () {
        if (add_next >= 1 && add_next < end) {
            add_next = add_next + 1;
            $(".steps").addClass("hide");
            $(".steps").removeClass("display");
            $("#step-" + add_next).removeClass("hide");
            $("#step-" + add_next).addClass("display");
            $("#prevStep").removeClass("hide");
            $("#prevStep").addClass("display");
            $(this).blur();
            if (add_next == end) {
                $(this).hide();
                $("#save-education-btn").removeClass("hide");
                $("#save-education-btn").addClass("display");
                $(this).addClass("hide");
                $(this).removeClass("display");
            }
        }
        $(".step-count").text(add_next);
    });

    // When the previous btn is clicked
    $("#prevStep").click(function () {
        if (add_next > 1 && add_next <= end) {
            add_next = add_next - 1;
            $(".steps").addClass("hide");
            $(".steps").removeClass("display");
            $("#step-" + add_next).removeClass("hide");
            $("#step-" + add_next).addClass("display");
            $("#nextStep").removeClass("hide");
            $("#nextStep").addClass("display");
            $("#save-education-btn").addClass("hide");
            $("#save-education-btn").removeClass("display");
            $("#nextStep").show();
            $(this).blur();
            if (add_next == 1) {
                $("#prevStep").removeClass("display");
                $("#prevStep").addClass("hide");
            }
        }
        $(".step-count").text(add_next);
    });

    $("#add-education-btn").click(function () {
        $(".mb-4").removeClass("has-error");
        $(".help-block").remove();
        $(".edu-mod-text").val("");

        $(".steps").addClass("display");
        $(".steps").removeClass("hide");
        $(".steps").addClass("hide");
        $(".steps").removeClass("display");

        $("#step-1").removeClass("hide");
        $("#step-1").addClass("display");

        $("#prevStep").removeClass("display");
        $("#prevStep").addClass("hide");
        $("#nextStep").removeClass("hide");
        $("#nextStep").addClass("display");
        $("#save-education-btn").removeClass("display");
        $("#save-education-btn").addClass("hide");

        add_next = 1;
        $("#addSchoolModal").modal("toggle");
    });

    $("#save-education-btn").click(function (event) {
        // Prepare data payload for submission
        $(".mb-4").removeClass("has-error");
        $(".mb-2").removeClass("has-error");
        $(".help-block").remove();

        //Set 
        var formData = {
            sch_name: $("#sch-name").val(),
            sch_country: $("#sch-country").val(),
            sch_region: $("#sch-region").val(),
            sch_city: $("#sch-city").val(),

            cert_type: $("#cert-type").val(),
            other_cert_type: $("#other-cert-type").val(),
            index_number: $("#index-number").val(),
            month_started: $("#month-started").val(),
            year_started: $("#year-started").val(),
            month_completed: $("#month-completed").val(),
            year_completed: $("#year-completed").val(),

            course_studied: $("#course-studied").val(),
            other_course_studied: $("#other-course-studied").val(),
            awaiting_result: $("#awaiting_result_value").val(),

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
            url: "../../api/education",
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
                    $("#sch-name-group").append('<div class="help-block" style="font-size:14px; color:red">' + data.errors.sch_name + "</div>");
                    step1 = 1;
                }
                if (data.errors.sch_country) {
                    $("#sch-country-group").addClass("has-error");
                    $("#sch-country-group").append('<div class="help-block" style="font-size:14px; color:red">' + data.errors.sch_country + "</div>");
                    step1 = 1;
                }
                if (data.errors.sch_region) {
                    $("#sch-region-group").addClass("has-error");
                    $("#sch-region-group").append('<div class="help-block" style="font-size:14px; color:red">' + data.errors.sch_region + "</div>");
                    step1 = 1;
                }
                if (data.errors.sch_city) {
                    $("#sch-city-group").addClass("has-error");
                    $("#sch-city-group").append('<div class="help-block" style="font-size:14px; color:red">' + data.errors.sch_city + "</div>");
                    step1 = 1;
                }

                //Step 2
                if (data.errors.cert_type) {
                    $("#cert-type-group").addClass("has-error");
                    $("#cert-type-group").append('<div class="help-block" style="font-size:14px; color:red">' + data.errors.cert_type + "</div>");
                    step2 = 2;
                }
                if (data.errors.index_number) {
                    $("#index-number-group").addClass("has-error");
                    $("#index-number-group").append('<div class="help-block" style="font-size:14px; color:red">' + data.errors.index_number + "</div>");
                    step2 = 2;
                }
                if (data.errors.date_started) {
                    $("#date-started-group").addClass("has-error");
                    $("#date-started-group").append('<div class="help-block" style="font-size:14px; color:red">' + data.errors.date_started + "</div>");
                    step2 = 2;
                }
                if (data.errors.date_completed) {
                    $("#date-completed-group").addClass("has-error");
                    $("#date-completed-group").append('<div class="help-block" style="font-size:14px; color:red">' + data.errors.date_completed + "</div>");
                    step2 = 2;
                }

                //Step 3
                if (data.errors.course_studied) {
                    $("#course-studied-group").addClass("has-error");
                    $("#course-studied-group").append('<div class="help-block" style="font-size:14px; color:red">' + data.errors.course_studied + "</div>");
                    step3 = 3;
                }

                // core
                if (data.errors.core_sbj_grp1) {
                    $("#core-sbj1-group").addClass("has-error");
                    $("#core-sbj1-group").append('<div class="help-block" style="font-size:14px; color:red">' + data.errors.core_sbj_grp1 + "</div>");
                    step3 = 3;
                }
                if (data.errors.core_sbj_grp2) {
                    $("#core-sbj2-group").addClass("has-error");
                    $("#core-sbj2-group").append('<div class="help-block" style="font-size:14px; color:red">' + data.errors.core_sbj_grp2 + "</div>");
                    step3 = 3;
                }
                if (data.errors.core_sbj_grp3) {
                    $("#core-sbj3-group").addClass("has-error");
                    $("#core-sbj3-group").append('<div class="help-block" style="font-size:14px; color:red">' + data.errors.core_sbj_grp3 + "</div>");
                    step3 = 3;
                }
                if (data.errors.core_sbj_grp4) {
                    $("#core-sbj4-group").addClass("has-error");
                    $("#core-sbj4-group").append('<div class="help-block" style="font-size:14px; color:red">' + data.errors.core_sbj_grp4 + "</div>");
                    step3 = 3;
                }

                //elective
                if (data.errors.elective_sbj_grp1) {
                    $("#elective-sbj1-group").addClass("has-error");
                    $("#elective-sbj1-group").append('<div class="help-block" style="font-size:14px; color:red">' + data.errors.elective_sbj_grp1 + "</div>");
                    step3 = 3;
                }
                if (data.errors.elective_sbj_grp2) {
                    $("#elective-sbj2-group").addClass("has-error");
                    $("#elective-sbj2-group").append('<div class="help-block" style="font-size:14px; color:red">' + data.errors.elective_sbj_grp2 + "</div>");
                    step3 = 3;
                }
                if (data.errors.elective_sbj_grp3) {
                    $("#elective-sbj3-group").addClass("has-error");
                    $("#elective-sbj3-group").append('<div class="help-block" style="font-size:14px; color:red">' + data.errors.elective_sbj_grp3 + "</div>");
                    step3 = 3;
                }
                if (data.errors.elective_sbj_grp4) {
                    $("#elective-sbj4-group").addClass("has-error");
                    $("#elective-sbj4-group").append('<div class="help-block" style="font-size:14px; color:red">' + data.errors.elective_sbj_grp4 + "</div>");
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
                    //alert(step_errors);
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
                    } else if (step_errors > 1 && step_errors < 3) {
                        $("#prevStep").removeClass("hide");
                        $("#prevStep").addClass("display");
                        $("#nextStep").removeClass("hide");
                        $("#nextStep").addClass("display");
                        $("#save-education-btn").removeClass("display");
                        $("#save-education-btn").addClass("hide");
                    }
                    //next = step_errors;
                    add_next = step_errors;
                }
                return;

            } else {
                alert(data.message);
                window.location.reload();
            }

        }).fail(function () {
            $("education-form").html('<div class="alert alert-danger">Could not reach server, please try again later.</div>');
        });
    });

    /*
        For edit Modal form
    */

    $("#edit-nextStep").click(function () {
        if (edit_next >= 1 && edit_next < end) {
            edit_next = edit_next + 1;
            $(".steps").addClass("hide");
            $(".steps").removeClass("display");
            $("#edit-step-" + edit_next).removeClass("hide");
            $("#edit-step-" + edit_next).addClass("display");
            $("#edit-prevStep").removeClass("hide");
            $("#edit-prevStep").addClass("display");
            $(this).blur();
            if (edit_next == end) {
                $(this).hide();
                $("#edit-save-education-btn").removeClass("hide");
                $("#edit-save-education-btn").addClass("display");
                $(this).addClass("hide");
                $(this).removeClass("display");
            }
        }
    });

    $("#edit-prevStep").click(function () {
        if (edit_next > 1 && edit_next <= end) {
            edit_next = edit_next - 1;
            $(".steps").addClass("hide");
            $(".steps").removeClass("display");
            $("#edit-step-" + edit_next).removeClass("hide");
            $("#edit-step-" + edit_next).addClass("display");
            $("#edit-nextStep").removeClass("hide");
            $("#edit-nextStep").addClass("display");
            $("#edit-save-education-btn").addClass("hide");
            $("#edit-save-education-btn").removeClass("display");
            $("#edit-nextStep").show();
            $(this).blur();
            if (edit_next == 1) {
                $("#edit-prevStep").removeClass("display");
                $("#edit-prevStep").addClass("hide");
            }
        }
    });

    $("#edit-education-form").on("submit", function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: "../../api/education-grades",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
        }).done(function (data) {
            console.log(data);
            
            let step_errors = 0;
            if (!data.success) {
                let step1, step2, step3, step4 = 0;
                let startPt = 1, endPt = 3;

                //Step 1
                if (data.errors.edit_sch_name) {
                    $("#edit-sch-name-group").addClass("has-error");
                    $("#edit-sch-name-group").append('<div class="help-block" style="font-size:14px; color:red">' + data.errors.edit_sch_name + "</div>");
                    step1 = 1;
                }
                if (data.errors.edit_sch_country) {
                    $("#edit-sch-country-group").addClass("has-error");
                    $("#edit-sch-country-group").append('<div class="help-block" style="font-size:14px; color:red">' + data.errors.edit_sch_country + "</div>");
                    step1 = 1;
                }
                if (data.errors.edit_sch_region) {
                    $("#edit-sch-region-group").addClass("has-error");
                    $("#edit-sch-region-group").append('<div class="help-block" style="font-size:14px; color:red">' + data.errors.edit_sch_region + "</div>");
                    step1 = 1;
                }
                if (data.errors.edit_sch_city) {
                    $("#edit-sch-city-group").addClass("has-error");
                    $("#edit-sch-city-group").append('<div class="help-block" style="font-size:14px; color:red">' + data.errors.edit_sch_city + "</div>");
                    step1 = 1;
                }

                //Step 2
                if (data.errors.edit_cert_type) {
                    $("#edit-cert-type-group").addClass("has-error");
                    $("#edit-cert-type-group").append('<div class="help-block" style="font-size:14px; color:red">' + data.errors.edit_cert_type + "</div>");
                    step2 = 2;
                }
                if (data.errors.edit_index_number) {
                    $("#edit-index-number-group").addClass("has-error");
                    $("#edit-index-number-group").append('<div class="help-block" style="font-size:14px; color:red">' + data.errors.edit_index_number + "</div>");
                    step2 = 2;
                }
                if (data.errors.edit_date_started) {
                    $("#edit-date-started-group").addClass("has-error");
                    $("#edit-date-started-group").append('<div class="help-block" style="font-size:14px; color:red">' + data.errors.edit_date_started + "</div>");
                    step2 = 2;
                }
                if (data.errors.edit_date_completed) {
                    $("#edit-date-completed-group").addClass("has-error");
                    $("#edit-date-completed-group").append('<div class="help-block" style="font-size:14px; color:red">' + data.errors.edit_date_completed + "</div>");
                    step2 = 2;
                }

                //Step 3
                if (data.errors.edit_course_studied) {
                    $("#edit-course-studied-group").addClass("has-error");
                    $("#edit-course-studied-group").append('<div class="help-block" style="font-size:14px; color:red">' + data.errors.edit_course_studied + "</div>");
                    step3 = 3;
                }

                // core
                if (data.errors.core_sbj_grp1) {
                    $("#edit-core-sbj1-group").addClass("has-error"); 
                    $("#edit-core-sbj1-group").append('<div class="help-block" style="font-size:14px; color:red">' + data.errors.core_sbj_grp1 + "</div>");
                    step3 = 3;
                }
                if (data.errors.core_sbj_grp2) {
                    $("#edit-core-sbj2-group").addClass("has-error");
                    $("#edit-core-sbj2-group").append('<div class="help-block" style="font-size:14px; color:red">' + data.errors.core_sbj_grp2 + "</div>");
                    step3 = 3;
                }
                if (data.errors.core_sbj_grp3) {
                    $("#edit-core-sbj3-group").addClass("has-error");
                    $("#edit-core-sbj3-group").append('<div class="help-block" style="font-size:14px; color:red">' + data.errors.core_sbj_grp3 + "</div>");
                    step3 = 3;
                }
                if (data.errors.core_sbj_grp4) {
                    $("#edit-core-sbj4-group").addClass("has-error");
                    $("#edit-core-sbj4-group").append('<div class="help-block" style="font-size:14px; color:red">' + data.errors.core_sbj_grp4 + "</div>");
                    step3 = 3;
                }

                //elective
                if (data.errors.elective_sbj_grp1) {
                    $("#edit-elective-sbj1-group").addClass("has-error");
                    $("#edit-elective-sbj1-group").append('<div class="help-block" style="font-size:14px; color:red">' + data.errors.elective_sbj_grp1 + "</div>");
                    step3 = 3;
                }
                if (data.errors.elective_sbj_grp2) {
                    $("#edit-elective-sbj2-group").addClass("has-error");
                    $("#edit-elective-sbj2-group").append('<div class="help-block" style="font-size:14px; color:red">' + data.errors.elective_sbj_grp2 + "</div>");
                    step3 = 3;
                }
                if (data.errors.elective_sbj_grp3) {
                    $("#edit-elective-sbj3-group").addClass("has-error");
                    $("#edit-elective-sbj3-group").append('<div class="help-block" style="font-size:14px; color:red">' + data.errors.elective_sbj_grp3 + "</div>");
                    step3 = 3;
                }
                if (data.errors.elective_sbj_grp4) {
                    $("#edit-elective-sbj4-group").addClass("has-error");
                    $("#edit-elective-sbj4-group").append('<div class="help-block" style="font-size:14px; color:red">' + data.errors.elective_sbj_grp4 + "</div>");
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
                    //alert(step_errors);
                    $(".steps").addClass("hide");
                    $(".steps").removeClass("display");
                    $("#edit-step-" + step_errors).removeClass("hide");
                    $("#edit-step-" + step_errors).addClass("display");

                    if (step_errors == startPt) {
                        $("#edit-prevStep").removeClass("display");
                        $("#edit-prevStep").addClass("hide");
                        $("#edit-nextStep").removeClass("hide");
                        $("#edit-nextStep").addClass("display");
                        $("#edit-save-education-btn").removeClass("display");
                        $("#edit-save-education-btn").addClass("hide");
                    } else if (step_errors == endPt) {
                        $("#edit-prevStep").removeClass("hide");
                        $("#edit-prevStep").addClass("display");
                        $("#edit-nextStep").removeClass("display");
                        $("#edit-nextStep").addClass("hide");
                        $("#edit-save-education-btn").removeClass("display");
                        $("#edit-save-education-btn").addClass("hide");
                    } else if (step_errors > startPt && step_errors < endPt) {
                        $("#edit-prevStep").removeClass("hide");
                        $("#edit-prevStep").addClass("display");
                        $("#edit-nextStep").removeClass("hide");
                        $("#edit-nextStep").addClass("display");
                        $("#edit-save-education-btn").removeClass("display");
                        $("#edit-save-education-btn").addClass("hide");
                    }
                    //next = step_errors;
                    add_next = step_errors;
                }
                return;

            } else {
                alert(data.message);
                window.location.reload();
            }
        }).fail(function (error) {
            console.log(error);
        })
    });

    //Edit button on each added education item
    $(".edit-edu-btn").click(function (e) {
        
        $.ajax({
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

            $("#edit-20eh29v1Tf").val(data["aca"][0]["s_number"]);
            $("#edit-sch-name").val(data["aca"][0]["school_name"].replace(/&amp;#039;/g, "'"));
            $("#edit-sch-country").val(data["aca"][0]["country"]);
            $("#edit-sch-region").val(data["aca"][0]["region"]);
            $("#edit-sch-city").val(data["aca"][0]["city"]);

            $("#edit-cert-type" + " option[value='" + data["aca"][0]["cert_type"] + "']").attr('selected', 'selected');
            $("#edit-other-cert-type").val(data["aca"][0]["other_cert_type"]);
            $("#edit-index-number").val(data["aca"][0]["index_number"]);
            $("#edit-month-started" + " option[value='" + data["aca"][0]["month_started"] + "']").attr('selected', 'selected');
            $("#edit-year-started" + " option[value='" + data["aca"][0]["year_started"] + "']").attr('selected', 'selected');
            $("#edit-month-completed" + " option[value='" + data["aca"][0]["month_completed"] + "']").attr('selected', 'selected');
            $("#edit-year-completed" + " option[value='" + data["aca"][0]["year_completed"] + "']").attr('selected', 'selected');

            $("#edit-course-studied").val(data["aca"][0]["course_of_study"]);
            $("#edit-other-course-studied").val(data["aca"][0]["other_course_studied"]);
            
            if (data["aca"][0]["awaiting_result"]) {
                $('input[name="edit-awaiting-result"][value="Yes"]').prop('checked', "checked");
                $('input[name="edit-awaiting-result"][value="No"]').prop('checked', "");
                $("#edit-not-waiting").slideUp();
            } else {
                $('input[name="edit-awaiting-result"][value="Yes"]').prop('checked', "");
                $('input[name="edit-awaiting-result"][value="No"]').prop('checked', "checked");
                $("#edit-not-waiting").slideDown();
            }

            // show the necessary fields per cert type
            var myArray = ['WASSCE', 'SSSCE', 'NECO', 'GBCE'];
            let index = $.inArray(data["aca"][0]["cert_type"], myArray);

            // if education history certificate type not in the list
            if (index == -1) {
                $("#edit-course-studied").slideUp();
                //$("#edit-course-studied option[value='OTHER']").attr('selected', 'selected');
                $(".edit-other-course-studied").slideDown();
                $(".edit-waec-course-content").slideUp();

                if (data["aca"][0]["cert_type"] == "OTHER" || data["aca"][0]["cert_type"] == "DIPLOMA" || data["aca"][0]["cert_type"] == "DEGREE" || data["aca"][0]["cert_type"] == "MASTERS") $(".edit-sepcific-cert").slideDown();

                /*$("#edit-awaiting-result-yes").prop("checked", "checked");
                $("#edit-awaiting-result-no").prop("checked", "");*/

            } else {
            
                //Append the grades to the dropdown list
                $(".subject-grade").html('<option value="Select" hidden>Select</option>');
                $.each(data["grades"], function (index, value) {
                    $(".subject-grade").append('<option value="' + value.grade + '">' + value.grade + '</option>');
                });
    
                //Append the grades to the dropdown list
                $(".elective-subjects").html('<option value="Select" hidden>Select</option>');
                $.each(data["elective_subjects"], function (index, value) {
                    $(".elective-subjects").append('<option value="' + value.subject + '">' + value.subject + '</option>');
                });
    
                // Set courses values (if cert type in 'WASSCE', 'SSSCE', 'NECO', 'GBCE')
                if (data["courses"]) {
                    //core subjects
                    for (let index = 0; index < 4; index++) {
                        if (data["courses"][index]["type"] == "core") {
                            $("#edit-core-sbj-grd" + (index + 1) + " option[value='" + data["courses"][index]["grade"] + "']").attr('selected', 'selected');
                            document.querySelector("#edit-core-sbj" + (index + 1)).dataset.type = "subject";
                            document.querySelector("#edit-core-sbj" + (index + 1)).dataset.value = data["courses"][index]["id"];
                            
                            document.querySelector("#edit-core-sbj-grd" + (index + 1)).dataset.type = "grade";
                            document.querySelector("#edit-core-sbj-grd" + (index + 1)).dataset.value = data["courses"][index]["id"];
                        }
                    }
    
                    //elective subjects
                    for (let index = 3; index < 8; index++) {
                        if (data["courses"][index]["type"] == "elective") {
                            $("#edit-elective-sbj" + (index - 3) + " option[value='" + data["courses"][index]["subject"] + "']").attr('selected', 'selected');
                            $("#edit-elective-sbj-grd" + (index - 3) + " option[value='" + data["courses"][index]["grade"] + "']").attr('selected', 'selected');
                            document.querySelector("#edit-elective-sbj" + (index - 3)).dataset.type = "subject";
                            document.querySelector("#edit-elective-sbj" + (index - 3)).dataset.value = data["courses"][index]["id"];
                            
                            document.querySelector("#edit-elective-sbj-grd" + (index - 3)).dataset.type = "grade";
                            document.querySelector("#edit-elective-sbj-grd" + (index - 3)).dataset.value = data["courses"][index]["id"];
                        }
                    }
    
                } /*else {
                    $("#edit-awaiting-result-yes").attr("checked", "checked");
                    $("#edit-awaiting-result-no").attr("checked", "");
                    $("#edit-not-waiting").slideUp();
                    //$("#edit-not-waiting").attr("class", "hide");
                }*/
                
                $("#edit-course-studied").slideDown();
                $(".edit-other-course-studied").slideUp();
                $(".edit-waec-course-content").slideDown();
                //$("#edit-not-waiting").slideDown();
                $(".edit-sepcific-cert").slideUp();
            }

            $(".steps").addClass("hide");
            $(".steps").removeClass("display");
            $("#edit-step-1").removeClass("hide");
            $("#edit-step-1").addClass("display");

            $("#edit-prevStep").removeClass("display");
            $("#edit-prevStep").addClass("hide");
            $("#edit-nextStep").removeClass("hide");
            $("#edit-nextStep").addClass("display");
            $("#edit-save-education-btn").removeClass("display");
            $("#edit-save-education-btn").addClass("hide");
            edit_next = 1;

            $("#editSchoolModal").modal("toggle");
        }).fail(function () {
            alert("Could not reach server, please try again later.")
        });

        e.preventDefault();
    });

    function updateData(data, url) {
        $.ajax({
            type: "PUT",
            url: "../../api/" + url,
            data: data,
            success: function (result) {
                console.log(result);
            },
            error: function (error) {
                console.log(error);
            }
        });
    }

    function prepareData(obj, snum, subj = false) {
        let subj_id = 0;
        let subj_type = "";

        if (subj) {
            subj_type = obj.dataset.type;
            subj_id = obj.dataset.value;
        }

        let data = {
            what: obj.name,
            value: obj.value,
            snum: snum,
            subj_type: subj_type,
            subj_id: subj_id
        };

        return data;
    }

    $(".form-select").change("blur", function () {
        if ($("#edit-20eh29v1Tf").val() != 1) {
            let data;
            if (this.dataset.value) {
                data = prepareData(this, $("#edit-20eh29v1Tf").val(), true);
            } else if (this.dataset.value) {
                data = prepareData(this, $("#edit-20eh29v1Tf").val(), true);
            } else {
                data = prepareData(this, $("#edit-20eh29v1Tf").val());
            }
            updateData(data, "education");
        }
    });

    $(".form-control").on("blur", function () {
        if ($("#edit-20eh29v1Tf").val() != 1) {
            let data = prepareData(this, $("#edit-20eh29v1Tf").val());
            updateData(data, "education");
        }
    });

    $(".form-radio").on("click", function () {
        if ($("#edit-20eh29v1Tf").val() != 1) {
            let data = prepareData(this, $("#edit-20eh29v1Tf").val());
            updateData(data, "education");
        }
    });

    $(".delete-edu-btn").on("click", function () {
        let answer = confirm("Are sure you want to delete this?");
        if (answer == true) {
            $.ajax({
                type: "DELETE",
                url: "../../api/education",
                data: {
                    what: "delete-edu-history",
                    value: $(this).attr("id"),
                },
                success: function (result) {
                    if (result["success"]) {
                        console.log(result);
                        window.location.reload();
                    }
                },
                error: function (error) {
                    console.log(error);
                }
            });
        }
    });

});
