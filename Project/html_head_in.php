<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <style>
        .page-item.active .page-link {
            background-color: #666666;
            border-color: #666666;
        }

        .fa-long-arrow-alt-up {
            color: #15141A;
        }

        .fa-long-arrow-alt-down {
            color: #15141A;
        }

        .fa-long-arrow-alt-up:hover {
            color: #666666;
        }

        .fa-long-arrow-alt-down:hover {
            color: #666666;
        }
        
        /* checkbox style start */

        input[type="checkbox"] {
            display: none;
        }

        input[type="checkbox"]+label {
            color: #f2f2f2;
        }

        input[type="checkbox"]+label span {
            display: inline-block;
            width: 19px;
            height: 19px;
            margin: -2px 10px 0 0;
            vertical-align: middle;
            background: url(img/check_radio_sheet.png) left top no-repeat;
            cursor: pointer;
        }

        input[type="checkbox"]:checked+label span {
            background: url(img/check_radio_sheet.png) -19px top no-repeat;
        }

        /* checkbox style end */

    </style>

</head>