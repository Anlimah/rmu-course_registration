<?php
session_start();
if (isset($_SESSION['ghAppLogin']) && $_SESSION['ghAppLogin'] == true) {
    if (!(isset($_SESSION["ghApplicant"]) && !empty($_SESSION['ghAppLogin']))) {
        header('Location: index.php?status=error&message=Invalid access!');
    }
} else {
    header('Location: index.php?status=error&message=Invalid access!');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/application-form.css">
</head>

<body>
    <div style="width: 100%; height: 40px; background-color:red;margin-bottom:10px">

    </div>
    <main>
        <form id="appForm">
            <fieldset>
                <legend>PERSONAL</legend>
                <div class="field-content">
                    <div class="form-fields" style="flex-grow: 8;">
                        <div class="mb-3">
                            <label for="title">TITLE</label>
                            <select name="title" id="title">
                                <option value="" selected>Select</option>
                                <option value="Mr">Mr.</option>
                                <option value="Mr">Mrs.</option>
                                <option value="Mr">Ms.</option>
                                <option value="Mr">Prof. Dr.</option>
                                <option value="Mr">Prof.</option>
                                <option value="Mr">Rev.</option>
                                <option value="Mr">Rev. Dr.</option>
                                <option value="Mr">Rev. Sis.</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="surname">SURNAME</label>
                            <input type="text" name="surname" id="surname">
                        </div>
                        <div class="mb-3">
                            <label for="first-name">FIRST NAME</label>
                            <input type="text" name="first-name" id="first-name">
                        </div>
                        <div class="mb-3">
                            <label for="other-names">OTHER NAMES</label>
                            <input type="text" name="other-names" id="other-names">
                        </div>
                        <div class="mb-3">
                            <label for="dob">DATE OF BIRTH</label>
                            <input type="date" name="dob" id="dob">
                        </div>
                        <div class="mb-3">
                            <label for="gender">GENDER</label>
                            <select name="gender" id="gender">
                                <option value="" selected>Select</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="marital-status">MARITAL STATUS</label>
                            <select name="marital-status" id="marital-status">
                                <option value="" selected>Select</option>
                                <option value="Single">Single</option>
                                <option value="Married">Married</option>
                                <option value="Divorced">Divorced</option>
                                <option value="Widowed">Widowed</option>
                                <option value="Separarted">Separarted</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="nationality">NATIONALITY</label>
                            <select name="nationality" id="nationality">
                                <option value="" selected>Select</option>
                                <option value="Single">Single</option>
                                <option value="Married">Married</option>
                                <option value="Divorced">Divorced</option>
                                <option value="Widowed">Widowed</option>
                                <option value="Separarted">Separarted</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="country">COUNTRY OF RESIDENCE</label>
                            <select name="country" id="country">
                                <option value="" selected>Select</option>
                                <option value="Single">Single</option>
                                <option value="Married">Married</option>
                                <option value="Divorced">Divorced</option>
                                <option value="Widowed">Widowed</option>
                                <option value="Separarted">Separarted</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="region">HOME REGION</label>
                            <select name="region" id="region">
                                <option value="" selected>Select</option>
                                <option value="Single">Single</option>
                                <option value="Married">Married</option>
                                <option value="Divorced">Divorced</option>
                                <option value="Widowed">Widowed</option>
                                <option value="Separarted">Separarted</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="home-town">HOME TOWN</label>
                            <input type="text" name="home-town" id="home-town">
                        </div>
                        <div class="mb-3">
                            <label for="disability">ANY DISABILITY?</label>
                            <select name="disability" id="disability">
                                <option value="" selected>Select</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                    </div>
                    <div class="photo-upload-area" style="flex-grow: 8;">
                        <p>gsdfjkhsd sd fjsdafkj safahs dfsdjka fkjasdjkfh sdfjkh sdjkafkjahkjfha skfasd kjfska</p>
                        <div class="photo-display"></div>
                        <label for="applicant-photo" id="upload-photo-label" class="btn btn-primary">Upload photo</label>
                        <input type="file" name="" id="applicant-photo">
                    </div>
                </div>
            </fieldset>

            <fieldset>
                <legend>PARENT/GUARDIAN</legend>

            </fieldset>

        </form>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

</body>

</html>