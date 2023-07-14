<!DOCTYPE html>
<html lang="en">

<head>

    <link rel="stylesheet" href="<?php echo $base_url ?>asset/jquery_ui.css">
    <script src="<?php echo $base_url ?>asset/jquery.js"></script>
    <script src="<?php echo $base_url ?>asset/jquery.ui.js"></script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Student Form</title>

    <style>
        /* Index */
        * {
            box-sizing: border-box;
            font-family: Arial, sans-serif;
            /* Set the desired clean font style */
        }
        .container {
    padding: 10px;
    width: 100%;
    max-width: 500px;
    margin: 0 auto;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

form {
    width: 100%;
    max-width: 300px;
}

input[type=text],
input[type=password],
input[type=date],
select {
    width: 100%;
    padding: 10px;
    margin: 3px 0; /* Adjust the margin value as desired */
    display: inline-block;
    border: none;
    background: #f1f1f1;
    border-radius: 10px;
    font-size: 10px;
    font-weight: 300;
}

.submit-button {
    margin-top: 10px;
}

input[type=text]:focus,
input[type=password]:focus,
input[type=date]:focus,
select:focus {
    background-color: #ddd;
    outline: none;
}

/* Rest of the CSS */


        hr {
            border: 1px solid #f1f1f1;
            margin-bottom:5px;
        }

        .registerbtn {
            background-color: #04AA6D;
            color: white;
            padding: 16px 20px;
            margin: 20px 0;
            border: none;
            cursor: pointer;
            width: 100%;
            opacity: 0.9;
        }

        .registerbtn:hover {
            opacity: 1;
        }

        /* Set a grey background color and center the text of the "sign in" section */
        .signin {
            background-color: #f1f1f1;
            text-align: center;
        }

        /* index */

        #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #customers td,
        #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #customers tr:nth-child(even) {
            background-color: #f2f2f2;
            
        }

        #customers tr:hover {
            background-color: #ddd;
        }

        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #04AA6D;
            color: white;
        }

        .button5 {
            font-weight: 200;
            background-color: #bfd200;
            color: white;
            padding: 10px 20px;
            border: none;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            margin: 10px 0;
            border-radius: 5px;
        }

        .button5:hover {
            background-color: green;
            color: white;
        }

        .header {
            font-weight: 200;
            background-color: #bfd200;
            color: white;
            padding: 10px 20px;
            border: none;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            margin: 10px 0;
            border-radius: 5px;
        }
        .form-row {
        display: grid;
        grid-template-columns: auto 1fr;
        align-items: center;
        gap: 10px;
    }

    </style>
    </style>

</head>

<body>