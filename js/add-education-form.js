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
        /*$(".edu-mod-text").val("");
        $(".edu-mod-date-m").val("Month");
        $(".edu-mod-date-y").val("Year");
        $(".edu-mod-select").val("Select");
        $(".edu-mod-grade").val("Grade");*/

        

        $(".steps").addClass("display");
        $(".steps").removeClass("hide");
        $("#reset").click();
        $(".edu-mod-date-m > option[value='Select']").attr('selected','true');
        /*$(".edu-mod-grade" + " option[value='Grade']").attr('selected','selected');*/
        

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

        next = 1;
        $("#addSchoolModal").modal("toggle");
    });

    //Edit button on each added education item
    $(".edit-edu-btn").click(function(e) {
        
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

            $("#20eh29v1Tf").val(data["aca"][0]["s_number"])
            $("#sch-name").val(data["aca"][0]["school_name"]);
            $("#sch-country").val(data["aca"][0]["country"]);
            $("#sch-region").val(data["aca"][0]["region"]);
            $("#sch-city").val(data["aca"][0]["city"]);
            
            $("#cert-type").val(data["aca"][0]["cert_type"]);
            $("#index-number").val(data["aca"][0]["index_number"]);
            $("#month-started" + " option[value='" + data["aca"][0]["month_started"] +"']").attr('selected','selected');
            $("#year-started" + " option[value='" + data["aca"][0]["year_started"] +"']").attr('selected','selected');
            $("#month-completed" + " option[value='" + data["aca"][0]["month_completed"] +"']").attr('selected','selected');
            $("#year-completed" + " option[value='" + data["aca"][0]["year_completed"] +"']").attr('selected','selected');
            
            $("#course-studied").val(data["aca"][0]["course_of_study"]);

            for (let index = 0; index < 4; index++) {
                if (data["courses"][index]["type"] == "core") {
                    $("#core-sbj-grd"+(index + 1)+" option[value='"+data["courses"][index]["grade"]+"']").attr('selected','selected');
                }
            }

            for (let index = 3; index < 8; index++) {
                if (data["courses"][index]["type"] == "elective") {
                    $("#elective-sbj"+(index - 3)+" option[value='"+data["courses"][index]["subject"]+"']").attr('selected','selected');
                    $("#elective-sbj-grd"+(index - 3)+" option[value='"+data["courses"][index]["grade"]+"']").attr('selected','selected');
                }
            }

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
            next = 1;

            $("#addSchoolModal").modal("toggle");
            
        }).fail(function () {
            alert("Could not reach server, please try again later.")
        });

        e.preventDefault();
    });

    function updateData(data, url) {
        $.ajax({
            type: "PUT",
            url: "../../api/"+url,
            data: data,
            success: function(result) {
                console.log(result);
            },
            error: function(error) {
                console.log(error);
            }
        });
    }

    $(".form-select").change("blur", function() {
        if ($("#20eh29v1Tf").val() != 1) {
            alert(1)
            let data = {
                what: this.name,
                value: this.value,
                snum: $("#20eh29v1Tf").val(),
            };
            let url = "education"
            updateData(data, url);
        }
    });

    $(".form-control").on("blur", function() {
        if ($("#20eh29v1Tf").val() != 1) {
            alert(1)
            let data = {
                what: this.name,
                value: this.value,
                snum: $("#20eh29v1Tf").val(),
            };
            let url = "education"
            updateData(data, url);
        }
    });

    $(".form-radio").on("click", function() {
        if ($("#20eh29v1Tf").val() != 1) {
            alert(1)
            let data = {
                what: this.name,
                value: this.value,
                snum: $("#20eh29v1Tf").val(),
            };
            let url = "education"
            updateData(data, url);
        }
    });

    $(".delete-edu-btn").on("click", function() {
        let answer = confirm("Are sure you want to delete this?");
        if (answer == true) {
            $.ajax({
                type: "DELETE",
                url: "../../api/education",
                data: {
                    what: "delete-edu-history",
                    value: $(this).attr("id"),
                },
                success: function(result) {
                    if (result["success"]) {
                        console.log(result);
                        window.location.reload();
                    }
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }
    });

    $("#save-education-btn").click(function (event) {
        // Prepare data payload for submission
        if ($("#20eh29v1Tf").val() == 1) {
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
                    return;

                } else {
                    alert(data.message);
                    window.location.reload();
                }

            }).fail(function () {
                $("education-form").html('<div class="alert alert-danger">Could not reach server, please try again later.</div>');
            });

        } else {
            alert("Data saved successfully!");
            window.location.reload();
        }

        event.preventDefault();
    });

  });
