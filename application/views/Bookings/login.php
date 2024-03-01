<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Southwinds Hotel</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Kaushan+Script&family=Poppins&display=swap');

        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-image: url(<?php echo base_url('assets/dist/img/HOTEL.jpeg'); ?>);
            background-color: rgba(0, 0, 0, 0.5);
            /* White color with 50% opacity */
            background-blend-mode: overlay;
            /* Apply overlay blend mode */
            background-repeat: no-repeat;
            background-size: cover;

            /* Prevent background image from repeating */
        }

        @media (max-width: 768px) {
            body {
                background-size: contain;
                /* or other appropriate value */
            }
        }

        .wrapper {
            max-width: 500px;
            border-radius: 10px;
            margin: 250px auto;
            padding: 30px 40px;
            background-color: #F3EDC8;
        }

        .h2 {
            font-family: 'Kaushan Script', cursive;
            font-size: 3rem;
            font-weight: bolder;
            color: #7D0A0A;
            font-style: italic;
            text-align: center;
            margin-bottom: 20px;
        }

        .h4 {
            font-family: 'Poppins', sans-serif;
            text-align: center;
            margin-bottom: 20px;
        }

        .input-field {
            border-radius: 5px;
            padding: 5px;
            display: flex;
            align-items: center;
            cursor: pointer;
            border: 1px solid #7D0A0A;
            background-color: #fff;
            color: #BF3131;
        }

        .input-field:hover {
            color: #7D0A0A;
            border: 1px solid #7D0A0A;
        }

        input {
            border: none;
            outline: none;
            box-shadow: none;
            width: 100%;
            padding: 0px 2px;
            font-family: 'Poppins', sans-serif;
            background-color: #fff;
        }

        .fa-eye-slash.btn {
            border: none;
            outline: none;
            box-shadow: none;
        }

        a {
            text-decoration: none;
            color: #400485;
            font-weight: 700;
        }

        a:hover {
            text-decoration: none;
            color: #7b4ca0;
        }

        .option {
            position: relative;
            padding-left: 30px;
            cursor: pointer;
        }

        .option label.text-muted {
            display: block;
            cursor: pointer;
        }

        .option input {
            display: none;
        }

        .checkmark {
            position: absolute;
            top: 3px;
            left: 0;
            height: 20px;
            width: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 50%;
            cursor: pointer;
        }

        .option input:checked~.checkmark:after {
            display: block;
        }

        .option .checkmark:after {
            content: "";
            width: 13px;
            height: 13px;
            display: block;
            background: #400485;
            position: absolute;
            top: 50%;
            left: 50%;
            border-radius: 50%;
            transform: translate(-50%, -50%) scale(0);
            transition: 300ms ease-in-out 0s;
        }

        .option input[type="radio"]:checked~.checkmark {
            background: #fff;
            transition: 300ms ease-in-out 0s;
            border: 1px solid #400485;
        }

        .option input[type="radio"]:checked~.checkmark:after {
            transform: translate(-50%, -50%) scale(1);
        }

        .btn.btn-block {
            border-radius: 20px;
            background-color: #BF3131;
            color: #fff;
        }

        .btn.btn-block:hover {
            background-color: #7D0A0A;
        }

        @media(max-width: 575px) {
            .wrapper {
                margin: 10px;
            }
        }

        @media(max-width: 424px) {
            .wrapper {
                padding: 30px 10px;
                margin: 5px;
            }

            .option {
                padding-left: 22px;
            }

            #forgot {
                font-size: 0.95rem;
            }

            .h2 {
                font-size: 2rem;
            }

            .h4 {
                font-size: 1rem;
            }
        }

        .logo {
            width: 60px;
            /* Adjust size as needed */
            height: auto;
            /* Maintain aspect ratio */
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="h2">
            <img src="<?php echo base_url('assets/dist/img/southwinds_logo.png'); ?>" alt="Southwinds Hotel Logo" class="logo">
            Southwinds Hotel
        </div>
        <form>
            <div class="form-group py-2">
                <div class="input-field"> <span class="far fa-user p-2"></span> <input type="text" placeholder="Username" required class=""> </div>
            </div>
            <div class="form-group py-1 pb-2">
                <div class="input-field"> <span class="fas fa-lock p-2"></span> <input id="passwordInput" type="password" placeholder="Password" required class=""> <button type="button" id="togglePassword" class="btn bg-white text-muted"> <span id="eyeIcon" class="far fa-eye-slash"></span> </button> </div>
            </div>
            <div class="d-flex align-items-start">
            </div> <button href="" class="btn btn-block text-center my-3">Log in</button>
        </form>
    </div>

    <script>
        document.getElementById('togglePassword').addEventListener('click', function() {
            var passwordInput = document.getElementById('passwordInput');
            var eyeIcon = document.getElementById('eyeIcon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            }
        });
    </script>
</body>


</html>